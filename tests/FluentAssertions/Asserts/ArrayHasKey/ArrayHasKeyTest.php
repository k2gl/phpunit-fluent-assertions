<?php

namespace App\Tests\FluentAssertions\Asserts\ArrayHasKey;

use App\Tests\FluentAssertions\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::arrayHasKey
 */
final class ArrayHasKeyTest extends FluentAssertionsTestCase
{
    public function testHasKey(): void
    {
        // act
        fact(['alpha' => 'beta'])->arrayHasKey('alpha');

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notHasKeyDataProvider
     */
    public function testNotHasKey(array $variable, int|string $key): void
    {
        // assert
        $this->incorrectAssertionExpected();

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
