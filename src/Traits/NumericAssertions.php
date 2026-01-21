<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use PHPUnit\Framework\Assert;

trait NumericAssertions
{
    // region Comparison Methods

    /**
     * Asserts that a numeric value is lower than another numeric value.
     *
     * This method checks if the actual value is strictly less than the expected value.
     * Both values must be of type int or float.
     *
     * Example usage:
     * fact(5)->isLowerThan(10); // Passes
     * fact(10)->isLowerThan(5); // Fails
     *
     * @param int|float $expected The value to compare against.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function isLowerThan(int|float $expected, string $message = ''): self
    {
        Assert::assertLessThan($expected, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a numeric value is greater than another numeric value.
     *
     * This method checks if the actual value is strictly greater than the expected value.
     * Both values must be of type int or float.
     *
     * Example usage:
     * fact(10)->isGreaterThan(5); // Passes
     * fact(5)->isGreaterThan(10); // Fails
     *
     * @param int|float $expected The value to compare against.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function isGreaterThan(int|float $expected, string $message = ''): self
    {
        Assert::assertGreaterThan($expected, $this->variable, $message);

        return $this;
    }

    // endregion Comparison Methods

    // region Sign Checks

    /**
     * Asserts that a numeric value is positive (greater than 0).
     *
     * This method checks if the actual value is greater than zero.
     *
     * Example usage:
     * fact(5)->isPositive(); // Passes
     * fact(-3)->isPositive(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function isPositive(string $message = ''): self
    {
        Assert::assertGreaterThan(0, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a numeric value is negative (less than 0).
     *
     * This method checks if the actual value is less than zero.
     *
     * Example usage:
     * fact(-3)->isNegative(); // Passes
     * fact(5)->isNegative(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function isNegative(string $message = ''): self
    {
        Assert::assertLessThan(0, $this->variable, $message);

        return $this;
    }

    // endregion Sign Checks

    // region Value Checks

    /**
     * Asserts that a numeric value is zero.
     *
     * This method checks if the actual value equals zero (supports int and float).
     *
     * Example usage:
     * fact(0)->isZero(); // Passes
     * fact(0.0)->isZero(); // Passes
     * fact(1)->isZero(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function isZero(string $message = ''): self
    {
        Assert::assertEquals(0, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a numeric value is between two values (inclusive).
     *
     * This method checks if min <= value <= max.
     *
     * Example usage:
     * fact(5)->isBetween(1, 10); // Passes
     * fact(15)->isBetween(1, 10); // Fails
     *
     * @param int|float $min The minimum value.
     * @param int|float $max The maximum value.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function isBetween(int|float $min, int|float $max, string $message = ''): self
    {
        Assert::assertTrue(
            $this->variable >= $min && $this->variable <= $max,
            $message ?: sprintf(
                'Failed asserting that %s is between %s and %s.',
                $this->variable,
                $min,
                $max
            )
        );

        return $this;
    }

    // endregion Value Checks
}