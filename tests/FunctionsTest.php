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
        $value = random_bytes(16);

        // act
        $sut = check($value);

        // assert
        self::assertInstanceOf(expected: FluentAssertions::class, actual: $sut);
        self::assertSame(expected: $value, actual: $sut->data);
    }

    public function testExpectMethod(): void
    {
        // arrange
        $value = random_bytes(16);

        // act
        $sut = expect($value);

        // assert
        self::assertInstanceOf(expected: FluentAssertions::class, actual: $sut);
        self::assertSame(expected: $value, actual: $sut->data);
    }

    public function testFactMethod(): void
    {
        // arrange
        $value = random_bytes(16);

        // act
        $sut = fact($value);

        // assert
        self::assertInstanceOf(expected: FluentAssertions::class, actual: $sut);
        self::assertSame(expected: $value, actual: $sut->data);
    }
}
