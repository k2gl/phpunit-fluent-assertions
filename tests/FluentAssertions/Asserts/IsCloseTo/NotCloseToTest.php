<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsCloseTo;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'notCloseTo')]
final class NotCloseToTest extends FluentAssertionsTestCase
{
    #[DataProvider('notCloseToDataProvider')]
    public function testNotCloseTo(mixed $variable, int|float $expected, float $delta): void
    {
        // act
        fact($variable)->notCloseTo($expected, $delta);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('closeToDataProvider')]
    public function testFailsWhenWithinDelta(mixed $variable, int|float $expected, float $delta): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->notCloseTo($expected, $delta);
    }

    public function testFailsOnFloatArithmeticNoiseByDefault(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(0.1 + 0.2)->notCloseTo(0.3);
    }

    public function testFailsWhenSubjectIsNotNumeric(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('1.0')->notCloseTo(2.0, 0.5);
    }

    public static function notCloseToDataProvider(): array
    {
        return [
            'outside delta'   => [1.0, 2.0, 0.5],
            'integer subject' => [10, 20, 0.5],
        ];
    }

    public static function closeToDataProvider(): array
    {
        return [
            'within delta'     => [99.985, 99.99, 0.005],
            'exactly on delta' => [1.5, 1.0, 0.5],
        ];
    }
}
