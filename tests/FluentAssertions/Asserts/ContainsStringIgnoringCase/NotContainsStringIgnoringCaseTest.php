<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\ContainsStringIgnoringCase;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::notContainsStringIgnoringCase
 */
final class NotContainsStringIgnoringCaseTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider notContainsStringDataProvider
     */
    public function testNotContainsStringIgnoringCase(string $variable, string $string): void
    {
        // act
        fact($variable)->notContainsStringIgnoringCase($string);

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider containsStringDataProvider
     */
    public function testContainsStringIgnoringCase(string $variable, string $string): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->notContainsStringIgnoringCase($string);
    }

    private function containsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'beta'],
            ['alpha beta gamma', 'BETA'],
            ['alpha beta gamma', 'BeTa'],
        ];
    }

    private function notContainsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'echo'],
            ['alpha beta gamma', 'ECHO'],
        ];
    }
}
