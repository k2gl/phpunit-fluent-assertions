<?php

namespace App\Tests\FluentAssertions\Count;

use App\Tests\Lib\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::count
 */
class CountTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider expectedCountDataProvider
     */
    public function testExpectedCount(array $variable, int $expectedCount): void
    {
        // act
        fact($variable)->count($expectedCount);

        // assert
        $this->correctAssertionExecuted();
    }

    public function testNotExpectedCount(): void
    {
        // assert
        $this->incorrectAssertionExpected();

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
