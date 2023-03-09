<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notNull
 */
class NotNullTest extends TestCase
{
    public function testDataIsNull(): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact(null)->notNull();
    }

    /**
     * @dataProvider dataProviderWhereDataIsNotNull
     */
    public function testDataIsNotNull(mixed $data): void
    {
        // act
        fact($data)->notNull();

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
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
