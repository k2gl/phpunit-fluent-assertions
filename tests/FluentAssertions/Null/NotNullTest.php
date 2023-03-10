<?php

namespace App\Tests\FluentAssertions\Null;

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
    public function testNull(): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact(null)->notNull();
    }

    /**
     * @dataProvider notNullDataProvider
     */
    public function testNotNull(mixed $variable): void
    {
        // act
        fact($variable)->notNull();

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    private function notNullDataProvider(): array
    {
        return [
            [true],
            [false],
            [0],
            [1],
            ['foo'],
            [['foo' => 'bar']],
            [(object) ['foo' => 'bar']],
            [fn() => false],
        ];
    }
}
