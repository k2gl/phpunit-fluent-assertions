<?php

namespace App\Tests\FluentAssertions\ContainsStringIgnoringCase;

use App\Tests\Lib\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::containsStringIgnoringCase
 */
class ContainsStringIgnoringCaseTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider containsStringDataProvider
     */
    public function testContainsStringIgnoringCase(string $variable, string $string): void
    {
        // act
        fact($variable)->containsStringIgnoringCase($string);

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notContainsStringDataProvider
     */
    public function testNotContainsStringIgnoringCase(string $variable, string $string): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->containsStringIgnoringCase($string);
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
