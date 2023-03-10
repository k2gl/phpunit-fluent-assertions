<?php

namespace App\Tests\FluentAssertions\ArrayHasKey;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::arrayHasKey
 */
class ArrayHasKeyTest extends TestCase
{
    public function testHasKey(): void
    {
        // act
        fact(['alpha' => 'beta'])->arrayHasKey('alpha');

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    /**
     * @dataProvider notHasKeyDataProvider
     */
    public function testNotHasKey(array $variable, int|string $key): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact($variable)->arrayHasKey($key);
    }

    private function notHasKeyDataProvider(): array
    {
        return [
            [[], 0],
            [['alpha', 'beta', 'gamma'], 3],
            [['alpha' => ['beta', 'gamma']], 'beta'],
        ];
    }
}
