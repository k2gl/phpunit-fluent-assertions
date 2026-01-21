<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsEmptyString;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isEmptyString')]
final class IsEmptyStringTest extends FluentAssertionsTestCase
{
    #[DataProvider('isEmptyStringDataProvider')]
    public function testIsEmptyString(mixed $variable): void
    {
        // act
        fact($variable)->isEmptyString();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsEmptyStringDataProvider')]
    public function testNotIsEmptyString(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isEmptyString();
    }

    public static function isEmptyStringDataProvider(): array
    {
        return [
            [''],
        ];
    }

    public static function notIsEmptyStringDataProvider(): array
    {
        return [
            ['a'],
            ['hello'],
            [' '],
        ];
    }
}