<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsNegative;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isNegative')]
final class IsNegativeTest extends FluentAssertionsTestCase
{
    #[DataProvider('isNegativeDataProvider')]
    public function testIsNegative(mixed $variable): void
    {
        // act
        fact($variable)->isNegative();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsNegativeDataProvider')]
    public function testNotIsNegative(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isNegative();
    }

    public static function isNegativeDataProvider(): array
    {
        return [
            [-1],
            [-2.5],
            [-100],
        ];
    }

    public static function notIsNegativeDataProvider(): array
    {
        return [
            [0],
            [1],
            [2.5],
        ];
    }
}