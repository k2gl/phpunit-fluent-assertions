<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Count;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::notCount
 */
final class NotCountTest extends FluentAssertionsTestCase
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
