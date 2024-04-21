<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\ContainsStringIgnoringCase;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'containsStringIgnoringCase')]
final class ContainsStringIgnoringCaseTest extends FluentAssertionsTestCase
{
    #[DataProvider('containsStringDataProvider')]
    public function testContainsStringIgnoringCase(string $variable, string $string): void
    {
        // act
        fact($variable)->containsStringIgnoringCase($string);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notContainsStringDataProvider')]
    public function testNotContainsStringIgnoringCase(string $variable, string $string): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->containsStringIgnoringCase($string);
    }

    public static function containsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'beta'],
            ['alpha beta gamma', 'BETA'],
            ['alpha beta gamma', 'BeTa'],
        ];
    }

    public static function notContainsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'echo'],
            ['alpha beta gamma', 'ECHO'],
        ];
    }
}
