<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\None;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'none')]
final class NoneTest extends FluentAssertionsTestCase
{
    #[DataProvider('noneDataProvider')]
    public function testNone(mixed $variable, callable $callback): void
    {
        // act
        fact($variable)->none($callback);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notNoneDataProvider')]
    public function testNotNone(mixed $variable, callable $callback): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->none($callback);
    }

    public static function noneDataProvider(): array
    {
        return [
            [[1, 2, 3], fn($v) => $v > 10],
            [['a' => 1, 'b' => 2], fn($v, $k) => $k === 'c'],
        ];
    }

    public static function notNoneDataProvider(): array
    {
        return [
            [[1, 2, 3], fn($v) => $v > 2],
            [[], fn($v) => true], // empty array
            ['not array', fn($v) => true], // not array
        ];
    }
}