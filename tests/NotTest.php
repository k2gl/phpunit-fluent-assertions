<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::not
 */
class NotTest extends TestCase
{
    /**
     * @dataProvider dataProviderWhereDataIsNotTheSameAsCompared
     */
    public function testDataIsNotTheSameAsCompared(mixed $data, mixed $compare): void
    {
        // act
        fact($data)->not($compare);

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    /**
     * @dataProvider dataProviderWhereDataIsTheSameAsCompared
     */
    public function testDataIsTheSameAsCompare(mixed $data, mixed $compare): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact($data)->not($compare);
    }

    public function dataProviderWhereDataIsNotTheSameAsCompared(): array
    {
        return [
            [1, 2],
            [false, 0],
            [0, false],
            ['0', 0],
            ['1', 1],
            [['foo' => 'bar'], ['bar' => 'foo']],
            [(object) ['foo' => 'bar'], (object) ['foo' => 'bar']],
            [fn() => false, fn() => true],
        ];
    }

    public function dataProviderWhereDataIsTheSameAsCompared(): array
    {
        return [
            [1, 1],
            [false, false],
            [null, null],
            ['0', '0'],
            [['foo' => 'bar'], ['foo' => 'bar']],
            [$object = (object) ['foo' => 'bar'], $object],
            [$fn = fn() => false, $fn],
        ];
    }
}
