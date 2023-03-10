<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::matchesRegularExpression
 */
class MatchesRegularExpressionTest extends TestCase
{
    /**
     * @dataProvider matchesRegularExpressionDataProvider
     */
    public function testMatchesRegularExpression(string $variable, string $pattern): void
    {
        // act
        fact($variable)->matchesRegularExpression($pattern);

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    /**
     * @dataProvider notMatchesRegularExpressionDataProvider
     */
    public function testNotMatchesRegularExpression(string $variable, string $pattern): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact($variable)->matchesRegularExpression($pattern);
    }

    private function matchesRegularExpressionDataProvider(): array
    {
        return [
            ['123456', '#^\d+$#'],
            ['alpha beta gamma', '/beta/'],
            ['alpha beta gamma', '#^\w+\s*\w+\s*\w+$#'],
        ];
    }

    private function notMatchesRegularExpressionDataProvider(): array
    {
        return [
            ['123456', '#^\D+$#'],
            ['alpha beta gamma', '/delta/'],
            ['alpha beta gamma', '#^\s+\w*\s+\w*\s+$#'],
        ];
    }
}
