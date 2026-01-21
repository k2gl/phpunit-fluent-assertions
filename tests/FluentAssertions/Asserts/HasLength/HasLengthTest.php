<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\HasLength;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'hasLength')]
final class HasLengthTest extends FluentAssertionsTestCase
{
    #[DataProvider('hasLengthDataProvider')]
    public function testHasLength(mixed $variable, mixed $length): void
    {
        // act
        fact($variable)->hasLength($length);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notHasLengthDataProvider')]
    public function testNotHasLength(mixed $variable, mixed $length): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->hasLength($length);
    }

    public static function hasLengthDataProvider(): array
    {
        return [
            ['abc', 3],
            ['hello', 5],
            ['', 0],
        ];
    }

    public static function notHasLengthDataProvider(): array
    {
        return [
            ['abcd', 3],
            ['hi', 5],
            ['a', 0],
        ];
    }
}