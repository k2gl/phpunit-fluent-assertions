<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\PHPStan;

use Closure;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\BinaryOp\Identical;
use PhpParser\Node\Expr\BinaryOp\NotIdentical;
use PhpParser\Node\Expr\BooleanNot;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\Instanceof_;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PHPStan\Analyser\Scope;
use PHPStan\Analyser\SpecifiedTypes;
use PHPStan\Analyser\TypeSpecifier;
use PHPStan\Analyser\TypeSpecifierAwareExtension;
use PHPStan\Analyser\TypeSpecifierContext;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\MethodTypeSpecifyingExtension;

/**
 * Teaches PHPStan to narrow the subject of a fluent assertion chain.
 *
 * Built in the spirit of phpstan/phpstan-webmozart-assert: every supported assertion
 * has a resolver that synthesises the equivalent PHP condition (`$x !== null`,
 * `$x instanceof Foo`, `$x === $expected`, ...) which is then handed to
 * TypeSpecifier::specifyTypesInCondition(). That reuses PHPStan's native condition
 * narrowing instead of re-implementing it.
 *
 * The one twist over webmozart: there the value is the assertion's own argument
 * (`Assert::notNull($value)`), whereas here it lives on the chain-opening call
 * (`fact($value)->notNull()`). {@see self::resolveSubject()} walks the chain back to the
 * fact()/check()/expect()/FluentAssertions::for() call and yields that argument.
 *
 * Only assertions whose narrowing is sound are wired up. equals() (loose ==) and not()
 * (would subtract a possibly-wide type, e.g. every string) are deliberately left out.
 *
 * Targets PHPStan 2.x.
 */
final class FluentAssertionsTypeSpecifyingExtension implements
    MethodTypeSpecifyingExtension,
    TypeSpecifierAwareExtension
{
    /** Lower-cased FQ names of the functions that open a fluent chain. */
    private const SUBJECT_FUNCTIONS = [
        'k2gl\\phpunitfluentassertions\\fact',
        'k2gl\\phpunitfluentassertions\\check',
        'k2gl\\phpunitfluentassertions\\expect',
    ];

    private TypeSpecifier $typeSpecifier;

    /**
     * Map of lower-cased method name => resolver building the equivalent condition.
     *
     * @var array<string, Closure(Expr, array<Arg>, Scope): ?Expr>|null
     */
    private static ?array $resolvers = null;

    public function setTypeSpecifier(TypeSpecifier $typeSpecifier): void
    {
        $this->typeSpecifier = $typeSpecifier;
    }

    public function getClass(): string
    {
        return FluentAssertions::class;
    }

    public function isMethodSupported(
        MethodReflection $methodReflection,
        MethodCall $node,
        TypeSpecifierContext $context,
    ): bool {
        // Act only on standalone assertion statements (the intended usage), the same
        // gate webmozart's extension applies via $context->null().
        return $context->null()
            && isset(self::getResolvers()[strtolower($methodReflection->getName())]);
    }

    public function specifyTypes(
        MethodReflection $methodReflection,
        MethodCall $node,
        Scope $scope,
        TypeSpecifierContext $context,
    ): SpecifiedTypes {
        $subject = $this->resolveSubject($node, $scope);
        if ($subject === null) {
            return new SpecifiedTypes();
        }

        $resolver = self::getResolvers()[strtolower($methodReflection->getName())] ?? null;
        if ($resolver === null) {
            return new SpecifiedTypes();
        }

        $condition = $resolver($subject, $node->getArgs(), $scope);
        if ($condition === null) {
            return new SpecifiedTypes();
        }

        return $this->typeSpecifier->specifyTypesInCondition(
            $scope,
            $condition,
            TypeSpecifierContext::createTruthy(),
        );
    }

    /**
     * Walk the fluent chain (`...->is()->notNull()`) back to the originating
     * fact()/check()/expect() or FluentAssertions::for() call and return its argument.
     */
    private function resolveSubject(MethodCall $node, Scope $scope): ?Expr
    {
        $var = $node->var;
        while ($var instanceof MethodCall) {
            $var = $var->var;
        }

        if ($var instanceof FuncCall && $var->name instanceof Name) {
            if (in_array(strtolower($scope->resolveName($var->name)), self::SUBJECT_FUNCTIONS, true)) {
                return $var->getArgs()[0]->value ?? null;
            }

            return null;
        }

        if (
            $var instanceof StaticCall
            && $var->class instanceof Name
            && strtolower($scope->resolveName($var->class)) === strtolower(FluentAssertions::class)
            && $var->name instanceof Identifier
            && strtolower($var->name->toString()) === 'for'
        ) {
            return $var->getArgs()[0]->value ?? null;
        }

        return null;
    }

    /**
     * @return array<string, Closure(Expr, array<Arg>, Scope): ?Expr>
     */
    private static function getResolvers(): array
    {
        if (self::$resolvers !== null) {
            return self::$resolvers;
        }

        return self::$resolvers = [
            'notnull' => static fn (Expr $s): Expr => new NotIdentical($s, self::const('null')),
            'null'    => static fn (Expr $s): Expr => new Identical($s, self::const('null')),
            'true'    => static fn (Expr $s): Expr => new Identical($s, self::const('true')),
            'nottrue' => static fn (Expr $s): Expr => new NotIdentical($s, self::const('true')),
            'false'   => static fn (Expr $s): Expr => new Identical($s, self::const('false')),
            'notfalse' => static fn (Expr $s): Expr => new NotIdentical($s, self::const('false')),

            'instanceof' => static function (Expr $s, array $args, Scope $scope): ?Expr {
                $class = self::classNameNode($args, $scope);

                return $class === null ? null : new Instanceof_($s, $class);
            },
            'notinstanceof' => static function (Expr $s, array $args, Scope $scope): ?Expr {
                $class = self::classNameNode($args, $scope);

                return $class === null ? null : new BooleanNot(new Instanceof_($s, $class));
            },

            // is() == assertSame(): the subject must be identical to the expected value.
            'is' => static function (Expr $s, array $args): ?Expr {
                $arg = $args[0] ?? null;

                return $arg instanceof Arg ? new Identical($s, $arg->value) : null;
            },

            // Type-check assertions narrow via the equivalent is_*() condition.
            'isstring'   => static fn (Expr $s): Expr => self::isType('is_string', $s),
            'isint'      => static fn (Expr $s): Expr => self::isType('is_int', $s),
            'isfloat'    => static fn (Expr $s): Expr => self::isType('is_float', $s),
            'isbool'     => static fn (Expr $s): Expr => self::isType('is_bool', $s),
            'isarray'    => static fn (Expr $s): Expr => self::isType('is_array', $s),
            'iscallable' => static fn (Expr $s): Expr => self::isType('is_callable', $s),
            'isresource' => static fn (Expr $s): Expr => self::isType('is_resource', $s),
        ];
    }

    private static function const(string $name): ConstFetch
    {
        return new ConstFetch(new Name($name));
    }

    private static function isType(string $function, Expr $subject): FuncCall
    {
        return new FuncCall(new Name($function), [new Arg($subject)]);
    }

    /**
     * @param array<mixed> $args
     */
    private static function classNameNode(array $args, Scope $scope): ?Name
    {
        $arg = $args[0] ?? null;
        if (!$arg instanceof Arg) {
            return null;
        }

        $classStrings = $scope->getType($arg->value)->getConstantStrings();
        if (count($classStrings) !== 1) {
            return null;
        }

        return new FullyQualified($classStrings[0]->getValue());
    }
}
