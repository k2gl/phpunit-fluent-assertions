<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\ContainsString;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::containsString
 */
final class ContainsStringTest extends FluentAssertionsTestCase
{
    public function testContainsString(): void
    {
        // act
        fact('alpha beta gamma')->containsString('beta');

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notContainsStringDataProvider
     */
    public function testNotContainsString(string $variable, string $string): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->containsString($string);
    }

    public static function notContainsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'echo'],
            ['alpha beta gamma', 'alphas'],
            ['alpha beta gamma', 'BETA'],
        ];
    }
}
