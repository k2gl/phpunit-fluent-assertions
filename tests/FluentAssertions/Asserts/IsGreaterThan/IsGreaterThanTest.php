<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsGreaterThan;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isGreaterThan')]
final class IsGreaterThanTest extends FluentAssertionsTestCase
{
    #[DataProvider('isGreaterThanDataProvider')]
    public function testIsGreaterThan(mixed $variable, mixed $compare): void
    {
        // act
        fact($variable)->isGreaterThan($compare);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsGreaterThanDataProvider')]
    public function testNotIsGreaterThan(mixed $variable, mixed $compare): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isGreaterThan($compare);
    }

    public static function isGreaterThanDataProvider(): array
    {
        return [
            [2, 1],
            [3.0, 2.1],
            [0, -1],
            [1.5, 0.5],
            [-3.3, -5.5],
        ];
    }

    public static function notIsGreaterThanDataProvider(): array
    {
        return [
            [1, 2],
            [2.1, 3.0],
            [-1, 0],
            [0.5, 1.5],
            [-5.5, -3.3],
            [1, 1],
            [2.0, 2.0],
            [0, 0],
        ];
    }
}