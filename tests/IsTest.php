<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::is
 */
class IsTest extends TestCase
{
    public function testPassedForInt(): void
    {
        // act
        FluentAssertions::for(7)->is(7);

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    public function testNotPassedForInt(): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        FluentAssertions::for(7)->is(77);
    }
}
