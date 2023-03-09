<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::null
 */
class NullTest extends TestCase
{
    public function testDataIsNull(): void
    {
        // act
        fact(null)->null();

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    /**
     * @dataProvider dataProviderWhereDataIsNotNull
     */
    public function testDataIsNotNull(mixed $data): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact($data)->null();
    }

    public function dataProviderWhereDataIsNotNull(): array
    {
        return [
            [true],
            [1],
            ['foo'],
            [['foo' => 'bar']],
            [(object) ['foo' => 'bar']],
            [fn() => false],
        ];
    }
}
