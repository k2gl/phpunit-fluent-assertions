<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::true
 */
class TrueTest extends TestCase
{

    public function testPassedForStrictTrue(): void
    {
        // act
        fact(true)->true();

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
        fact($data)->true();
    }

    public function dataThatShouldNotPass(): array
    {
        return [
            [false],
            [0],
            [1],
            ['0'],
            ['1'],
            [(object) ['foo' => 'bar']],
            [fn() => false],
        ];
    }
}
