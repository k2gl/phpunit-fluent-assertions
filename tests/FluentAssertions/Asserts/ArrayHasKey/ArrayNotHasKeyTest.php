<?php

namespace App\Tests\FluentAssertions\Asserts\ArrayHasKey;

use App\Tests\FluentAssertions\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::arrayNotHasKey
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
