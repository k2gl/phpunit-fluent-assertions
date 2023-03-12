<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\MatchesRegularExpression;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::matchesRegularExpression
 */
final class MatchesRegularExpressionTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider matchesRegularExpressionDataProvider
     */
    public function testMatchesRegularExpression(string $variable, string $pattern): void
    {
        // act
        fact($variable)->matchesRegularExpression($pattern);

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notMatchesRegularExpressionDataProvider
     */
    public function testNotMatchesRegularExpression(string $variable, string $pattern): void
    {
        // assert
        $this->incorrectAssertionExpected();

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
