<?php

namespace App\Tests\FluentAssertions\Count;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::count
 */
class CountTest extends TestCase
{
    /**
     * @dataProvider expectedCountDataProvider
     */
    public function testExpectedCount(array $variable, int $expectedCount): void
    {
        // act
        fact($variable)->count($expectedCount);

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    public function testNotExpectedCount(): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact(['alpha', 'beta', 'gamma'])->count(44);
    }

    private function expectedCountDataProvider(): array
    {
        return [
            [[], 0],
            [['alpha', 'beta', 'gamma'], 3],
            [['alpha' => ['beta', 'gamma']], 1],
        ];
    }
}
