<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;

/**
 * @phpstan-require-extends FluentAssertions
 */
trait ComparisonAndEqualityAssertions
{
    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference the same object.
     *
     * This method performs a strict comparison (===) between the actual value and the expected value.
     *
     * Example usage:
     * fact(42)->is(42); // Passes
     * fact(42)->is('42'); // Fails due to type difference
     *
     * @param mixed $expected The expected value to compare against.
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function is(mixed $expected, string $message = ''): self
    {
        Assert::assertSame($expected, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that two variables are equal.
     *
     * This method performs a loose comparison (==) between the actual value and the expected value.
     *
     * Example usage:
     * fact(42)->equals(42); // Passes
     * fact(42)->equals('42'); // Passes due to loose comparison
     *
     * @param mixed $expected The expected value to compare against.
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function equals(mixed $expected, string $message = ''): self
    {
        Assert::assertEquals($expected, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that two variables do not have the same type and value.
     * Used on objects, it asserts that two variables do not reference the same object.
     *
     * This method performs a strict comparison (!==) to ensure the actual value is not the same as the expected value.
     *
     * Example usage:
     * fact(42)->not(43); // Passes
     * fact(42)->not(42); // Fails
     *
     * @param mixed $expected The value that the actual value should not be.
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function not(mixed $expected, string $message = ''): self
    {
        Assert::assertNotSame($expected, $this->variable, $message);

        return $this;
    }
}