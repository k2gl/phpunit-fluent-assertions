<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::not
 */
class NotTest extends TestCase
{
    public function testPassedForInt(): void
    {
        // act
        FluentAssertions::for(7)->not(77);

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    public function testNotPassedForInt(): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        FluentAssertions::for(7)->not(7);
    }
}
