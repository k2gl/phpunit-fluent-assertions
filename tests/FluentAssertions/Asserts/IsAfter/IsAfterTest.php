<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsAfter;

use DateTimeImmutable;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isAfter')]
final class IsAfterTest extends FluentAssertionsTestCase
{
    public function testIsAfterStringExpectation(): void
    {
        // act
        fact(new DateTimeImmutable('2024-12-31'))->isAfter('2024-01-01');

        // assert
        $this->correctAssertionExecuted();
    }

    public function testFailsWhenNotAfter(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(new DateTimeImmutable('2024-01-01'))->isAfter('2024-12-31');
    }

    public function testFailsWhenSubjectIsNotDateTime(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(42)->isAfter('2024-01-01');
    }
}
