<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsPositive;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isPositive')]
final class IsPositiveTest extends FluentAssertionsTestCase
{
    #[DataProvider('isPositiveDataProvider')]
    public function testIsPositive(mixed $variable): void
    {
        // act
        fact($variable)->isPositive();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsPositiveDataProvider')]
    public function testNotIsPositive(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isPositive();
    }

    public static function isPositiveDataProvider(): array
    {
        return [
            [1],
            [2.5],
            [100],
        ];
    }

    public static function notIsPositiveDataProvider(): array
    {
        return [
            [0],
            [-1],
            [-2.5],
        ];
    }
}