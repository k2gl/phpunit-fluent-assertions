<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Contains;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'contains')]
final class ContainsTest extends FluentAssertionsTestCase
{
    #[DataProvider('containsDataProvider')]
    public function testContains(mixed $variable, mixed $value): void
    {
        // act
        fact($variable)->contains($value);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notContainsDataProvider')]
    public function testNotContains(mixed $variable, mixed $value): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->contains($value);
    }

    public static function containsDataProvider(): array
    {
        return [
            [[1, 2, 3], 2],
            [['a', 'b'], 'a'],
            [[1, null], null],
        ];
    }

    public static function notContainsDataProvider(): array
    {
        return [
            [[1, 2], 3],
            [['a', 'b'], 'c'],
            [[], 1],
        ];
    }
}