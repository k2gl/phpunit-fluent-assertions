<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsEmptyArray;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isEmptyArray')]
final class IsEmptyArrayTest extends FluentAssertionsTestCase
{
    #[DataProvider('isEmptyArrayDataProvider')]
    public function testIsEmptyArray(mixed $variable): void
    {
        // act
        fact($variable)->isEmptyArray();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsEmptyArrayDataProvider')]
    public function testNotIsEmptyArray(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isEmptyArray();
    }

    public static function isEmptyArrayDataProvider(): array
    {
        return [
            [[]],
        ];
    }

    public static function notIsEmptyArrayDataProvider(): array
    {
        return [
            [[1]],
            [[1, 2]],
            [['a' => 'b']],
        ];
    }
}