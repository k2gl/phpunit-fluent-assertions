<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsBool;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isBool')]
final class IsBoolTest extends FluentAssertionsTestCase
{
    #[DataProvider('isBoolDataProvider')]
    public function testIsBool(mixed $variable): void
    {
        // act
        fact($variable)->isBool();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsBoolDataProvider')]
    public function testNotIsBool(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isBool();
    }

    public static function isBoolDataProvider(): array
    {
        return [
            [true],
            [false],
        ];
    }

    public static function notIsBoolDataProvider(): array
    {
        return [
            [1],
            [0],
            ['true'],
            [null],
        ];
    }
}