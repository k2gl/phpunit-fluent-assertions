<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Some;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'some')]
final class SomeTest extends FluentAssertionsTestCase
{
    #[DataProvider('someDataProvider')]
    public function testSome(mixed $variable, callable $callback): void
    {
        // act
        fact($variable)->some($callback);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notSomeDataProvider')]
    public function testNotSome(mixed $variable, callable $callback): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->some($callback);
    }

    public static function someDataProvider(): array
    {
        return [
            [[1, 2, 3], fn($v) => $v > 2],
            [['a' => 1, 'b' => 2], fn($v, $k) => $k === 'b'],
        ];
    }

    public static function notSomeDataProvider(): array
    {
        return [
            [[1, 2, 3], fn($v) => $v > 10],
            [[], fn($v) => true], // empty array
            ['not array', fn($v) => true], // not array
        ];
    }
}