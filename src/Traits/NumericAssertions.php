<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;

/**
 * @phpstan-require-extends FluentAssertions
 */
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
     * @return self  Enables fluent chaining of assertion methods.
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
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function isGreaterThan(int|float $expected, string $message = ''): self
    {
        Assert::assertGreaterThan($expected, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a numeric value is greater than or equal to another numeric value.
     *
     * The non-strict counterpart of isGreaterThan().
     *
     * Example usage:
     * fact(10)->isGreaterThanOrEqual(10); // Passes
     * fact(5)->isGreaterThanOrEqual(10); // Fails
     *
     * @param int|float $expected The value to compare against.
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function isGreaterThanOrEqual(int|float $expected, string $message = ''): self
    {
        Assert::assertGreaterThanOrEqual($expected, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a numeric value is lower than or equal to another numeric value.
     *
     * The non-strict counterpart of isLowerThan().
     *
     * Example usage:
     * fact(5)->isLowerThanOrEqual(5); // Passes
     * fact(10)->isLowerThanOrEqual(5); // Fails
     *
     * @param int|float $expected The value to compare against.
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function isLowerThanOrEqual(int|float $expected, string $message = ''): self
    {
        Assert::assertLessThanOrEqual($expected, $this->variable, $message);

        return $this;
    }

    // endregion Comparison Methods

    // region Tolerance

    /**
     * Asserts that a numeric value equals the expected one within a tolerance.
     *
     * The default delta is PHP_FLOAT_EPSILON, which covers the usual reason floats
     * fail a strict comparison — accumulated arithmetic noise. It is an absolute
     * tolerance, so magnitudes far from 1.0 and domain rounding (money, percentages)
     * need a delta of their own.
     *
     * Example usage:
     * fact(0.1 + 0.2)->isCloseTo(0.3); // Passes
     * fact(99.985)->isCloseTo(99.99, 0.005); // Passes
     * fact(99.9)->isCloseTo(99.99, 0.005); // Fails
     *
     * @param int|float $expected The value to compare against.
     * @param float $delta The maximum accepted absolute difference.
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function isCloseTo(int|float $expected, float $delta = PHP_FLOAT_EPSILON, string $message = ''): self
    {
        if (! is_int($this->variable) && ! is_float($this->variable)) {
            Assert::fail($message ?: 'Variable is not numeric.');
        }

        Assert::assertEqualsWithDelta($expected, $this->variable, $delta, $message);

        return $this;
    }

    /**
     * Asserts that a numeric value differs from the expected one by more than a tolerance.
     *
     * The inverse of isCloseTo(), with the same default delta.
     *
     * Example usage:
     * fact(1.0)->notCloseTo(2.0); // Passes
     * fact(0.1 + 0.2)->notCloseTo(0.3); // Fails
     *
     * @param int|float $expected The value to compare against.
     * @param float $delta The maximum difference that would still count as equal.
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function notCloseTo(int|float $expected, float $delta = PHP_FLOAT_EPSILON, string $message = ''): self
    {
        if (! is_int($this->variable) && ! is_float($this->variable)) {
            Assert::fail($message ?: 'Variable is not numeric.');
        }

        Assert::assertNotEqualsWithDelta($expected, $this->variable, $delta, $message);

        return $this;
    }

    // endregion Tolerance

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
     * @return self  Enables fluent chaining of assertion methods.
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
     * @return self  Enables fluent chaining of assertion methods.
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
     * @return self  Enables fluent chaining of assertion methods.
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
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function isBetween(int|float $min, int|float $max, string $message = ''): self
    {
        if (! is_int($this->variable) && ! is_float($this->variable)) {
            Assert::fail($message ?: 'Variable is not numeric.');
        }

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

    /**
     * Asserts that a numeric value is not zero.
     *
     * The inverse of isZero().
     *
     * Example usage:
     * fact(1)->isNotZero(); // Passes
     * fact(0.0)->isNotZero(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function isNotZero(string $message = ''): self
    {
        Assert::assertNotEquals(0, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a numeric value is finite — neither an infinity nor NAN.
     *
     * Example usage:
     * fact(1.5)->isFinite(); // Passes
     * fact(INF)->isFinite(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function isFinite(string $message = ''): self
    {
        if (! is_int($this->variable) && ! is_float($this->variable)) {
            Assert::fail($message ?: 'Variable is not numeric.');
        }

        Assert::assertTrue(is_finite((float) $this->variable), $message ?: 'Failed asserting that the value is finite.');

        return $this;
    }

    /**
     * Asserts that a float is NAN.
     *
     * NAN is not equal to itself, so the usual equality assertions cannot express this.
     *
     * Example usage:
     * fact(sqrt(-1))->isNan(); // Passes
     * fact(1.0)->isNan(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function isNan(string $message = ''): self
    {
        if (! is_float($this->variable)) {
            Assert::fail($message ?: 'Variable is not a float.');
        }

        Assert::assertTrue(is_nan($this->variable), $message ?: 'Failed asserting that the value is NAN.');

        return $this;
    }

    // endregion Value Checks
}
