<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsFloat;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isFloat')]
final class IsFloatTest extends FluentAssertionsTestCase
{
    #[DataProvider('isFloatDataProvider')]
    public function testIsFloat(mixed $variable): void
    {
        // act
        fact($variable)->isFloat();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsFloatDataProvider')]
    public function testNotIsFloat(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isFloat();
    }

    public static function isFloatDataProvider(): array
    {
        return [
            [3.14],
            [0.0],
            [-1.5],
        ];
    }

    public static function notIsFloatDataProvider(): array
    {
        return [
            [42],
            ['3.14'],
            [true],
            [null],
        ];
    }
}