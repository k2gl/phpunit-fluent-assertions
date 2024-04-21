<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\ArrayHasKey;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'arrayNotHasKey')]
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
