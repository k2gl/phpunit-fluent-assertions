<?php

namespace App\Tests\FluentAssertions\Count;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notCount
 */
class NotCountTest extends TestCase
{
    /**
     * @dataProvider wrongElementsCountDataProvider
     */
    public function testWrongElementsCount(array $variable, int $elementsCount): void
    {
        // act
        fact($variable)->notCount($elementsCount);

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    public function testRightElementsCount(): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

        // act
        fact(['alpha', 'beta', 'gamma'])->notCount(3);
    }

    private function wrongElementsCountDataProvider(): array
    {
        return [
            [['alpha', 'beta', 'gamma'], 2],
            [['alpha', 'beta', 'gamma'], 4],
        ];
    }
}
