<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsCloseTo;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isCloseTo')]
final class IsCloseToTest extends FluentAssertionsTestCase
{
    #[DataProvider('isCloseToDataProvider')]
    public function testIsCloseTo(mixed $variable, int|float $expected, float $delta): void
    {
        // act
        fact($variable)->isCloseTo($expected, $delta);

        // assert
        $this->correctAssertionExecuted();
    }

    public function testAbsorbsFloatArithmeticNoiseByDefault(): void
    {
        // act
        fact(0.1 + 0.2)->isCloseTo(0.3);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsCloseToDataProvider')]
    public function testNotIsCloseTo(mixed $variable, int|float $expected, float $delta): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isCloseTo($expected, $delta);
    }

    public function testFailsWhenSubjectIsNotNumeric(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('99.99')->isCloseTo(99.99, 0.005);
    }

    public static function isCloseToDataProvider(): array
    {
        return [
            'within delta'        => [99.985, 99.99, 0.005],
            'exactly on delta'    => [1.5, 1.0, 0.5],
            'exact match'         => [1.0, 1.0, 0.0],
            'integer subject'     => [10, 10.4, 0.5],
            'negative values'     => [-1.004, -1.0, 0.005],
        ];
    }

    public static function notIsCloseToDataProvider(): array
    {
        return [
            'outside delta'  => [99.9, 99.99, 0.005],
            'zero delta'     => [0.1 + 0.2, 0.3, 0.0],
            'wrong sign'     => [1.0, -1.0, 0.5],
        ];
    }
}
