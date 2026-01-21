<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsNotEmptyArray;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isNotEmptyArray')]
final class IsNotEmptyArrayTest extends FluentAssertionsTestCase
{
    #[DataProvider('isNotEmptyArrayDataProvider')]
    public function testIsNotEmptyArray(mixed $variable): void
    {
        // act
        fact($variable)->isNotEmptyArray();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsNotEmptyArrayDataProvider')]
    public function testNotIsNotEmptyArray(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isNotEmptyArray();
    }

    public static function isNotEmptyArrayDataProvider(): array
    {
        return [
            [[1]],
            [[1, 2]],
            [['a' => 'b']],
        ];
    }

    public static function notIsNotEmptyArrayDataProvider(): array
    {
        return [
            [[]],
        ];
    }
}