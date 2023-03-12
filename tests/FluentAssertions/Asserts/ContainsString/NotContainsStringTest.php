<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\ContainsString;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::notContainsString
 */
final class NotContainsStringTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider notContainsStringDataProvider
     */
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

    private function notContainsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'echo'],
            ['alpha beta gamma', 'BETA'],
        ];
    }
}
