<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\MatchesRegularExpression;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::notMatchesRegularExpression
 */
final class NotMatchesRegularExpressionTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider notMatchesRegularExpressionDataProvider
     */
    public function testNotMatchesRegularExpression(string $variable, string $pattern): void
    {
        // act
        fact($variable)->notMatchesRegularExpression($pattern);

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider matchesRegularExpressionDataProvider
     */
    public function testMatchesRegularExpression(string $variable, string $pattern): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->notMatchesRegularExpression($pattern);
    }

    public static function notMatchesRegularExpressionDataProvider(): array
    {
        return [
            ['123456', '#^\D+$#'],
            ['alpha beta gamma', '/delta/'],
            ['alpha beta gamma', '#^\s+\w*\s+\w*\s+$#'],
        ];
    }

    public static function matchesRegularExpressionDataProvider(): array
    {
        return [
            ['123456', '#^\d+$#'],
            ['alpha beta gamma', '/beta/'],
            ['alpha beta gamma', '#^\w+\s*\w+\s*\w+$#'],
        ];
    }
}
