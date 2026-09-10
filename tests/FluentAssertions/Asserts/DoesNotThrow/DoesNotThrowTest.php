<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\DoesNotThrow;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use RuntimeException;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'doesNotThrow')]
final class DoesNotThrowTest extends FluentAssertionsTestCase
{
    public function testPassesWhenNothingIsThrown(): void
    {
        // act
        fact(static fn () => 42)->doesNotThrow();

        // assert
        $this->correctAssertionExecuted();
    }

    public function testFailsWhenTheSubjectThrows(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(static fn () => throw new RuntimeException('boom'))->doesNotThrow();
    }

    public function testFailsWhenSubjectIsNotCallable(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('not callable')->doesNotThrow();
    }
}
