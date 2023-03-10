<?php

namespace App\Tests\FluentAssertions\True;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notTrue
 */
class NotTrueTest extends TestCase
{
    public function testTrue(): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact(true)->notTrue();
    }

    /**
     * @dataProvider notTrueDataProvider
     */
    public function testNotTrue(mixed $variable): void
    {
        // act
        fact($variable)->notTrue();

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    private function notTrueDataProvider(): array
    {
        return [
            [null],
            [false],
            [0],
            [1],
            ['0'],
            ['1'],
            [['foo' => 'bar'], ['foo' => 'bar']],
            [(object) ['foo' => 'bar']],
            [fn() => true],
        ];
    }
}
