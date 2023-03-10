<?php

namespace App\Tests\FluentAssertions\ArrayHasKey;

use App\Tests\Lib\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::arrayNotHasKey
 */
class ArrayNotHasKeyTest extends FluentAssertionsTestCase
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
