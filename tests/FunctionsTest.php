<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\check;
use function k2gl\PHPUnitFluentAssertions\expect;
use function k2gl\PHPUnitFluentAssertions\fact;

class FunctionsTest extends TestCase
{
    public function testCheckMethod(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $sut = check(variable: $variable);

        // assert
        self::assertInstanceOf(expected: FluentAssertions::class, actual: $sut);
        self::assertSame(expected: $variable, actual: $sut->variable);
    }

    public function testExpectMethod(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $sut = expect(variable: $variable);

        // assert
        self::assertInstanceOf(expected: FluentAssertions::class, actual: $sut);
        self::assertSame(expected: $variable, actual: $sut->variable);
    }

    public function testFactMethod(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $sut = fact(variable: $variable);

        // assert
        self::assertInstanceOf(expected: FluentAssertions::class, actual: $sut);
        self::assertSame(expected: $variable, actual: $sut->variable);
    }
}
