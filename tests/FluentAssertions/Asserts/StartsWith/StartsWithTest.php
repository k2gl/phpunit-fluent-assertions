<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\StartsWith;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'startsWith')]
final class StartsWithTest extends FluentAssertionsTestCase
{
    #[DataProvider('startsWithDataProvider')]
    public function testStartsWith(mixed $variable, mixed $prefix): void
    {
        // act
        fact($variable)->startsWith($prefix);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notStartsWithDataProvider')]
    public function testNotStartsWith(mixed $variable, mixed $prefix): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->startsWith($prefix);
    }

    public static function startsWithDataProvider(): array
    {
        return [
            ['hello world', 'hello'],
            ['test string', 'test'],
            ['abc', 'a'],
        ];
    }

    public static function notStartsWithDataProvider(): array
    {
        return [
            ['world hello', 'hello'],
            ['string test', 'test'],
            ['abc', 'b'],
        ];
    }
}