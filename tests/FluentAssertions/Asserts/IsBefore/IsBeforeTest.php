<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsBefore;

use DateTimeImmutable;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isBefore')]
final class IsBeforeTest extends FluentAssertionsTestCase
{
    public function testIsBeforeStringExpectation(): void
    {
        // act
        fact(new DateTimeImmutable('2024-01-01'))->isBefore('2024-12-31');

        // assert
        $this->correctAssertionExecuted();
    }

    public function testIsBeforeDateTimeExpectation(): void
    {
        // act
        fact(new DateTimeImmutable('2024-01-01 10:00:00'))->isBefore(new DateTimeImmutable('2024-01-01 11:00:00'));

        // assert
        $this->correctAssertionExecuted();
    }

    public function testFailsWhenNotBefore(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(new DateTimeImmutable('2025-01-01'))->isBefore('2024-12-31');
    }

    public function testFailsWhenSubjectIsNotDateTime(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('2024-01-01')->isBefore('2024-12-31');
    }
}
