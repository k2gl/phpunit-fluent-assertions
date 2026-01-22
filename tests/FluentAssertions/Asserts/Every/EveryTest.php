<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Every;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'every')]
final class EveryTest extends FluentAssertionsTestCase
{
    #[DataProvider('everyDataProvider')]
    public function testEvery(mixed $variable, callable $callback): void
    {
        // act
        fact($variable)->every($callback);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notEveryDataProvider')]
    public function testNotEvery(mixed $variable, callable $callback): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->every($callback);
    }

    public static function everyDataProvider(): array
    {
        return [
            [[2, 4, 6], fn($v) => $v % 2 === 0],
            [['a' => 1, 'b' => 3], fn($v, $k) => $v > 0],
        ];
    }

    public static function notEveryDataProvider(): array
    {
        return [
            [[1, 2, 3], fn($v) => $v > 5],
            [[], fn($v) => true], // empty array
            ['not array', fn($v) => true], // not array
        ];
    }
}