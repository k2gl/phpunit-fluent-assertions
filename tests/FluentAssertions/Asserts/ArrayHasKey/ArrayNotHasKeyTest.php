<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\ArrayHasKey;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::arrayNotHasKey
 */
final class ArrayNotHasKeyTest extends FluentAssertionsTestCase
{
    public function testNotHasKey(): void
    {
        // act
        fact(['alpha' => 'beta'])->arrayNotHasKey('beta');

        // assert
        $this->correctAssertionExecuted();
    }

    public function testHasKey(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(['alpha' => 'beta'])->arrayNotHasKey('alpha');
    }
}
