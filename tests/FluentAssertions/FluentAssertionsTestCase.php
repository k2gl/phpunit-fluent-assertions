<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

abstract class FluentAssertionsTestCase extends TestCase
{
    protected function hasExpectedVariable(FluentAssertions $fluentAssertions, mixed $expected): void
    {
        self::assertSame($expected, $fluentAssertions->variable);
    }

    protected function correctAssertionExecuted(): void
    {
        $this->correctAssertionsExecuted(expected: 1);
    }

    protected function correctAssertionsExecuted(int $expected = 1): void
    {
        $performedAssertionCounts = Assert::getCount();

        self::assertSame($expected, $performedAssertionCounts);
    }

    protected function incorrectAssertionExpected(): void
    {
        $this->expectException(ExpectationFailedException::class);
    }
}