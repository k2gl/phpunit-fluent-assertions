<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsLowerThan;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isLowerThan')]
final class IsLowerThanTest extends FluentAssertionsTestCase
{
    #[DataProvider('isLowerThanDataProvider')]
    public function testIsLowerThan(mixed $variable, mixed $compare): void
    {
        // act
        fact($variable)->isLowerThan($compare);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsLowerThanDataProvider')]
    public function testNotIsLowerThan(mixed $variable, mixed $compare): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isLowerThan($compare);
    }

    public static function isLowerThanDataProvider(): array
    {
        return [
            [1, 2],
            [2.1, 3.0],
            [-1, 0],
            [0.5, 1.5],
            [-5.5, -3.3],
        ];
    }

    public static function notIsLowerThanDataProvider(): array
    {
        return [
            [2, 1],
            [3.0, 2.1],
            [0, -1],
            [1.5, 0.5],
            [-3.3, -5.5],
            [1, 1],
            [2.0, 2.0],
            [0, 0],
        ];
    }
}