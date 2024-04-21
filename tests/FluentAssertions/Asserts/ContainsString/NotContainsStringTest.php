<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\ContainsString;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'notContainsString')]
final class NotContainsStringTest extends FluentAssertionsTestCase
{
    #[DataProvider('notContainsStringDataProvider')]
    public function testNotContainsString(string $variable, string $string): void
    {
        // act
        fact($variable)->notContainsString($string);

        // assert
        $this->correctAssertionExecuted();
    }

    public function testContainsString(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('alpha beta gamma')->notContainsString('beta');
    }

    public static function notContainsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'echo'],
            ['alpha beta gamma', 'BETA'],
        ];
    }
}
