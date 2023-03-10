<?php

namespace App\Tests\FluentAssertions\Count;

use App\Tests\Lib\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notCount
 */
class NotCountTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider wrongElementsCountDataProvider
     */
    public function testWrongElementsCount(array $variable, int $elementsCount): void
    {
        // act
        fact($variable)->notCount($elementsCount);

        // assert
        $this->correctAssertionExecuted();
    }

    public function testRightElementsCount(): void
    {
        // assert
        $this->incorrectAssertionExpected();

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
