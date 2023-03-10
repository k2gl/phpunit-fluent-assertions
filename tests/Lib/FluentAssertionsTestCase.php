<?php
declare(strict_types=1);

namespace App\Tests\Lib;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

class FluentAssertionsTestCase extends TestCase
{
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