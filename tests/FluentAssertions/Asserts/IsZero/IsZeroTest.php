<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsZero;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isZero')]
final class IsZeroTest extends FluentAssertionsTestCase
{
    #[DataProvider('isZeroDataProvider')]
    public function testIsZero(mixed $variable): void
    {
        // act
        fact($variable)->isZero();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsZeroDataProvider')]
    public function testNotIsZero(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isZero();
    }

    public static function isZeroDataProvider(): array
    {
        return [
            [0],
            [0.0],
            [-0],
        ];
    }

    public static function notIsZeroDataProvider(): array
    {
        return [
            [1],
            [-1],
            [0.1],
        ];
    }
}