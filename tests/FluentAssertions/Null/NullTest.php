<?php

namespace App\Tests\FluentAssertions\Null;

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
    public function testNull(): void
    {
        // act
        fact(null)->null();

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    /**
     * @dataProvider notNullDataProvider
     */
    public function testNotNull(mixed $variable): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact($variable)->null();
    }

    private function notNullDataProvider(): array
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
