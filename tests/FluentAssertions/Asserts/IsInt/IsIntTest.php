<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsInt;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isInt')]
final class IsIntTest extends FluentAssertionsTestCase
{
    #[DataProvider('isIntDataProvider')]
    public function testIsInt(mixed $variable): void
    {
        // act
        fact($variable)->isInt();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsIntDataProvider')]
    public function testNotIsInt(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isInt();
    }

    public static function isIntDataProvider(): array
    {
        return [
            [42],
            [0],
            [-5],
        ];
    }

    public static function notIsIntDataProvider(): array
    {
        return [
            [42.0],
            ['42'],
            [true],
        ];
    }
}