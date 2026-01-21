<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsBetween;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isBetween')]
final class IsBetweenTest extends FluentAssertionsTestCase
{
    #[DataProvider('isBetweenDataProvider')]
    public function testIsBetween(mixed $variable, mixed $min, mixed $max): void
    {
        // act
        fact($variable)->isBetween($min, $max);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsBetweenDataProvider')]
    public function testNotIsBetween(mixed $variable, mixed $min, mixed $max): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isBetween($min, $max);
    }

    public static function isBetweenDataProvider(): array
    {
        return [
            [5, 1, 10],
            [1.5, 1.0, 2.0],
            [0, -1, 1],
        ];
    }

    public static function notIsBetweenDataProvider(): array
    {
        return [
            [15, 1, 10],
            [0.5, 1.0, 2.0],
            [-2, -1, 1],
        ];
    }
}