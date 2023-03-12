<?php declare(strict_types=1);

namespace App\Tests\FluentAssertions;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

abstract class FluentAssertionsTestCase extends TestCase
{
    protected function hasExpectedVariable(FluentAssertions $fluentAssertions, mixed $expected): void
    {
        self::assertSame(expected: $expected, actual: $fluentAssertions->variable);
    }

    protected function correctAssertionExecuted(): void
    {
        $this->correctAssertionsExecuted(expected: 1);
    }

    protected function correctAssertionsExecuted(int $expected = 1): void
    {
        $performedAssertionCounts = Assert::getCount();

        self::assertSame(expected: $expected, actual: $performedAssertionCounts);
    }

    protected function incorrectAssertionExpected(): void
    {
        $this->expectException(ExpectationFailedException::class);
    }
}