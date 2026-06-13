<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\Assert;

/**
 * @phpstan-require-extends \K2gl\PHPUnitFluentAssertions\FluentAssertions
 */
trait DateTimeAssertions
{
    /**
     * Asserts that the subject (a DateTimeInterface) is strictly before the
     * expected moment. A string expectation is parsed as a DateTimeImmutable.
     *
     * Example usage:
     * fact(new DateTimeImmutable('2024-01-01'))->isBefore('2024-12-31');
     */
    public function isBefore(DateTimeInterface|string $expected, string $message = ''): self
    {
        Assert::assertLessThan($this->toDateTime($expected), $this->subjectDateTime(), $message);

        return $this;
    }

    /**
     * Asserts that the subject (a DateTimeInterface) is strictly after the
     * expected moment. A string expectation is parsed as a DateTimeImmutable.
     */
    public function isAfter(DateTimeInterface|string $expected, string $message = ''): self
    {
        Assert::assertGreaterThan($this->toDateTime($expected), $this->subjectDateTime(), $message);

        return $this;
    }

    /**
     * Asserts that the subject falls on the same calendar date (Y-m-d) as the
     * expected moment, ignoring the time of day.
     */
    public function isSameDate(DateTimeInterface|string $expected, string $message = ''): self
    {
        Assert::assertSame(
            $this->toDateTime($expected)->format('Y-m-d'),
            $this->subjectDateTime()->format('Y-m-d'),
            $message,
        );

        return $this;
    }

    private function subjectDateTime(): DateTimeInterface
    {
        $subject = $this->variable;

        if (! $subject instanceof DateTimeInterface) {
            Assert::fail('This assertion expects the subject to be a DateTimeInterface.');
        }

        return $subject;
    }

    private function toDateTime(DateTimeInterface|string $value): DateTimeInterface
    {
        return is_string($value) ? new DateTimeImmutable($value) : $value;
    }
}
