<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsGreaterThanOrEqual;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isGreaterThanOrEqual')]
final class IsGreaterThanOrEqualTest extends FluentAssertionsTestCase
{
    #[DataProvider('isGreaterThanOrEqualDataProvider')]
    public function testIsGreaterThanOrEqual(int|float $variable, int|float $expected): void
    {
        // act
        fact($variable)->isGreaterThanOrEqual($expected);

        // assert
        // assertGreaterThanOrEqual()/assertLessThanOrEqual() build a composite constraint,
        // so PHPUnit counts two assertions for a single fluent call.
        $this->correctAssertionsExecuted(expected: 2);
    }

    #[DataProvider('notIsGreaterThanOrEqualDataProvider')]
    public function testNotIsGreaterThanOrEqual(int|float $variable, int|float $expected): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isGreaterThanOrEqual($expected);
    }

    public static function isGreaterThanOrEqualDataProvider(): array
    {
        return [
            'greater'      => [10, 5],
            'equal'        => [10, 10],
            'equal floats' => [1.5, 1.5],
            'mixed types'  => [10, 9.5],
        ];
    }

    public static function notIsGreaterThanOrEqualDataProvider(): array
    {
        return [
            'lower'        => [5, 10],
            'lower floats' => [1.4, 1.5],
        ];
    }
}
