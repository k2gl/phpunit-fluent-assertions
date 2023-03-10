<?php

namespace App\Tests\FluentAssertions\ArrayHasKey;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::arrayNotHasKey
 */
class ArrayNotHasKeyTest extends TestCase
{
    public function testNotHasKey(): void
    {
        // act
        fact(['alpha' => 'beta'])->arrayNotHasKey('beta');

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    public function testHasKey(): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact(['alpha' => 'beta'])->arrayNotHasKey('alpha');
    }
}
