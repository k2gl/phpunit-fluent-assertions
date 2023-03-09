<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions
 */
class FluentAssertionsTest extends TestCase
{
    public function testConstructor(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $sut = new FluentAssertions(variable: $variable);

        // assert
        self::assertInstanceOf(expected: FluentAssertions::class, actual: $sut);
        self::assertSame(expected: $variable, actual: $sut->variable);
    }

    public function testStaticConstructor(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $sut = FluentAssertions::for(variable: $variable);

        // assert
        self::assertInstanceOf(expected: FluentAssertions::class, actual: $sut);
        self::assertSame(expected: $variable, actual: $sut->variable);
    }
}
