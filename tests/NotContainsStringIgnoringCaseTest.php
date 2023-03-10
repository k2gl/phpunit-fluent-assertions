<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notContainsStringIgnoringCase
 */
class NotContainsStringIgnoringCaseTest extends TestCase
{
    /**
     * @dataProvider notContainsStringDataProvider
     */
    public function testNotContainsStringIgnoringCase(string $variable, string $string): void
    {
        // act
        fact($variable)->notContainsStringIgnoringCase($string);

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    /**
     * @dataProvider containsStringDataProvider
     */
    public function testContainsStringIgnoringCase(string $variable, string $string): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

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
