<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsArray;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isArray')]
final class IsArrayTest extends FluentAssertionsTestCase
{
    #[DataProvider('isArrayDataProvider')]
    public function testIsArray(mixed $variable): void
    {
        // act
        fact($variable)->isArray();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsArrayDataProvider')]
    public function testNotIsArray(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isArray();
    }

    public static function isArrayDataProvider(): array
    {
        return [
            [[]],
            [[1, 2, 3]],
            [['key' => 'value']],
        ];
    }

    public static function notIsArrayDataProvider(): array
    {
        return [
            ['string'],
            [42],
            [true],
            [null],
        ];
    }
}