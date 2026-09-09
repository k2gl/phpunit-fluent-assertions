<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsNotZero;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isNotZero')]
final class IsNotZeroTest extends FluentAssertionsTestCase
{
    #[DataProvider('isNotZeroDataProvider')]
    public function testIsNotZero(mixed $variable): void
    {
        // act
        fact($variable)->isNotZero();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('isZeroDataProvider')]
    public function testFailsOnZero(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isNotZero();
    }

    public static function isNotZeroDataProvider(): array
    {
        return [
            'positive int'   => [1],
            'negative int'   => [-1],
            'positive float' => [0.1],
        ];
    }

    public static function isZeroDataProvider(): array
    {
        return [
            'int zero'      => [0],
            'float zero'    => [0.0],
            'negative zero' => [-0.0],
        ];
    }
}
