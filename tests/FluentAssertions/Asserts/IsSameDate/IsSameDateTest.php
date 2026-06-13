<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsSameDate;

use DateTimeImmutable;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isSameDate')]
final class IsSameDateTest extends FluentAssertionsTestCase
{
    public function testSameCalendarDateIgnoringTime(): void
    {
        // act
        fact(new DateTimeImmutable('2024-06-13 23:59:00'))->isSameDate('2024-06-13 00:00:01');

        // assert
        $this->correctAssertionExecuted();
    }

    public function testFailsOnDifferentDate(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(new DateTimeImmutable('2024-06-13'))->isSameDate('2024-06-14');
    }

    public function testFailsWhenSubjectIsNotDateTime(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('2024-06-13')->isSameDate('2024-06-13');
    }
}
