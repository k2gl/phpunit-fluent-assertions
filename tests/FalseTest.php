<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::false
 */
class FalseTest extends TestCase
{
    public function testPassedForStrictFalse(): void
    {
        // act
        fact(false)->false();

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    /**
     * @dataProvider dataThatShouldNotPass
     */
    public function testNotPassedForOtherValues(mixed $data): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact($data)->false();
    }

    public function dataThatShouldNotPass(): array
    {
        return [
            [true],
            [0],
            [1],
            ['0'],
            ['1'],
            [(object) ['foo' => 'bar']],
            [fn() => true],
        ];
    }
}
