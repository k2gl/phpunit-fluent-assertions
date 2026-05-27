<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\PHPStan\Data;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use K2gl\PHPUnitFluentAssertions\Tests\PHPStan\Holder;

use function K2gl\PHPUnitFluentAssertions\check;
use function K2gl\PHPUnitFluentAssertions\fact;
use function PHPStan\Testing\assertType;

/** @param array{something: string}|null $context */
function notNullOnVariable(?array $context): void
{
    fact($context)->notNull();
    assertType('array{something: string}', $context);
}

function notNullOnProperty(Holder $holder): void
{
    fact($holder->context)->notNull();
    assertType('array{something: string}', $holder->context);
}

function nullCase(?string $value): void
{
    fact($value)->null();
    assertType('null', $value);
}

function trueCase(bool $flag): void
{
    fact($flag)->true();
    assertType('true', $flag);
}

function notTrueCase(bool $flag): void
{
    fact($flag)->notTrue();
    assertType('false', $flag);
}

function falseCase(bool $flag): void
{
    check($flag)->false();
    assertType('false', $flag);
}

function notFalseCase(bool $flag): void
{
    fact($flag)->notFalse();
    assertType('true', $flag);
}

function instanceOfCase(?DateTimeInterface $date): void
{
    fact($date)->instanceOf(DateTimeImmutable::class);
    assertType('DateTimeImmutable', $date);
}

/** @param DateTime|DateTimeImmutable $date */
function notInstanceOfCase(DateTime|DateTimeImmutable $date): void
{
    fact($date)->notInstanceOf(DateTimeImmutable::class);
    assertType('DateTime', $date);
}

function isCase(mixed $value, string $something): void
{
    fact($value)->is($something);
    assertType('string', $value);
}

function chainedCase(?string $value): void
{
    fact($value)->notNull()->is('expected');
    assertType("'expected'", $value);
}

function isStringCase(mixed $value): void
{
    fact($value)->isString();
    assertType('string', $value);
}

function isIntCase(mixed $value): void
{
    fact($value)->isInt();
    assertType('int', $value);
}

function isFloatCase(mixed $value): void
{
    fact($value)->isFloat();
    assertType('float', $value);
}

function isBoolCase(mixed $value): void
{
    fact($value)->isBool();
    assertType('bool', $value);
}

function isArrayCase(mixed $value): void
{
    fact($value)->isArray();
    assertType('array<mixed, mixed>', $value);
}

function isCallableCase(mixed $value): void
{
    fact($value)->isCallable();
    assertType('callable(): mixed', $value);
}

function isResourceCase(mixed $value): void
{
    fact($value)->isResource();
    assertType('resource', $value);
}

/** Unsupported assertions (equals is loose ==) must NOT narrow. */
function unsupportedDoesNotNarrow(?string $value): void
{
    fact($value)->equals('foo');
    assertType('string|null', $value);
}
