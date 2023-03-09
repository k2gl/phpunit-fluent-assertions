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
    public function testTrue(): void
    {
        // act
        fact(true)->true();

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    /**
     * @dataProvider notTrueDataProvider
     */
    public function testNotTrue(mixed $variable): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact($variable)->true();
    }

    public function notTrueDataProvider(): array
    {
        return [
            [null],
            [false],
            [0],
            [1],
            ['0'],
            ['1'],
            ['foo'],
            [(object) ['foo' => 'bar']],
            [fn() => null],
        ];
    }
}
