<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Throws;

use DomainException;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use RuntimeException;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'throws')]
final class ThrowsTest extends FluentAssertionsTestCase
{
    public function testThrowsExpectedException(): void
    {
        // act
        fact(static fn () => throw new RuntimeException('boom'))->throws(RuntimeException::class);

        // assert
        $this->correctAssertionExecuted();
    }

    public function testThrowsWithMessageSubstring(): void
    {
        // act
        fact(static fn () => throw new DomainException('value is invalid'))
            ->throws(DomainException::class, 'invalid');

        // assert
        $this->correctAssertionsExecuted(expected: 2);
    }

    public function testFailsWhenWrongExceptionType(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(static fn () => throw new RuntimeException('boom'))->throws(DomainException::class);
    }

    public function testFailsWhenNothingThrown(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(static fn () => 42)->throws(RuntimeException::class);
    }

    public function testFailsWhenSubjectIsNotCallable(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('not callable')->throws(RuntimeException::class);
    }
}
