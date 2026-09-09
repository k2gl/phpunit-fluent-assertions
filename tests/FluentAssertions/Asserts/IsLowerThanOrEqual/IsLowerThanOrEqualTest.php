<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsLowerThanOrEqual;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isLowerThanOrEqual')]
final class IsLowerThanOrEqualTest extends FluentAssertionsTestCase
{
    #[DataProvider('isLowerThanOrEqualDataProvider')]
    public function testIsLowerThanOrEqual(int|float $variable, int|float $expected): void
    {
        // act
        fact($variable)->isLowerThanOrEqual($expected);

        // assert
        // assertGreaterThanOrEqual()/assertLessThanOrEqual() build a composite constraint,
        // so PHPUnit counts two assertions for a single fluent call.
        $this->correctAssertionsExecuted(expected: 2);
    }

    #[DataProvider('notIsLowerThanOrEqualDataProvider')]
    public function testNotIsLowerThanOrEqual(int|float $variable, int|float $expected): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isLowerThanOrEqual($expected);
    }

    public static function isLowerThanOrEqualDataProvider(): array
    {
        return [
            'lower'        => [5, 10],
            'equal'        => [10, 10],
            'equal floats' => [1.5, 1.5],
            'mixed types'  => [9.5, 10],
        ];
    }

    public static function notIsLowerThanOrEqualDataProvider(): array
    {
        return [
            'greater'        => [10, 5],
            'greater floats' => [1.6, 1.5],
        ];
    }
}
