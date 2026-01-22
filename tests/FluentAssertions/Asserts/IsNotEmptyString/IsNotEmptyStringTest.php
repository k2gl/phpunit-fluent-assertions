<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsNotEmptyString;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isNotEmptyString')]
final class IsNotEmptyStringTest extends FluentAssertionsTestCase
{
    #[DataProvider('isNotEmptyStringDataProvider')]
    public function testIsNotEmptyString(mixed $variable): void
    {
        // act
        fact($variable)->isNotEmptyString();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsNotEmptyStringDataProvider')]
    public function testNotIsNotEmptyString(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isNotEmptyString();
    }

    public static function isNotEmptyStringDataProvider(): array
    {
        return [
            ['a'],
            ['hello'],
            [' '],
        ];
    }

    public static function notIsNotEmptyStringDataProvider(): array
    {
        return [
            [''],
        ];
    }
}