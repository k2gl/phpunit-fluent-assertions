<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Throws;

use DomainException;
use LogicException;
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

    public function testInspectReceivesTheThrownException(): void
    {
        // arrange
        $seen = null;

        // act
        fact(static fn () => throw new DomainException('boom', 42))
            ->throws(DomainException::class, inspect: static function (DomainException $e) use (&$seen): void {
                $seen = $e;
                fact($e->getCode())->is(42);
            });

        // assert: instance-of, the code check inside the callback
        $this->correctAssertionsExecuted(expected: 2);
        fact($seen)->instanceOf(DomainException::class);
    }

    public function testInspectRunsAfterTheTypeCheck(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act: the callback is never reached for the wrong type
        fact(static fn () => throw new RuntimeException('boom'))
            ->throws(DomainException::class, inspect: static fn (): never => throw new LogicException('unreachable'));
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
