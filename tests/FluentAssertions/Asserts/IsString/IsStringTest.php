<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsString;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isString')]
final class IsStringTest extends FluentAssertionsTestCase
{
    #[DataProvider('isStringDataProvider')]
    public function testIsString(mixed $variable): void
    {
        // act
        fact($variable)->isString();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsStringDataProvider')]
    public function testNotIsString(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isString();
    }

    public static function isStringDataProvider(): array
    {
        return [
            ['text'],
            [''],
            ['42'],
        ];
    }

    public static function notIsStringDataProvider(): array
    {
        return [
            [42],
            [42.0],
            [true],
        ];
    }
}