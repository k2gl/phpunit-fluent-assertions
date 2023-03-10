<?php

namespace App\Tests\FluentAssertions\False;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notFalse
 */
class NotFalseTest extends TestCase
{
    public function testFalse(): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact(false)->notFalse();
    }

    /**
     * @dataProvider notFalseDataProvider
     */
    public function testNotFalse(mixed $variable): void
    {
        // act
        fact($variable)->notFalse();

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    private function notFalseDataProvider(): array
    {
        return [
            [null],
            [true],
            [0],
            [1],
            ['0'],
            ['1'],
            [['foo' => 'bar'], ['foo' => 'bar']],
            [(object) ['foo' => 'bar']],
            [fn() => false],
        ];
    }
}
