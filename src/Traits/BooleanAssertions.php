<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;

/**
 * @phpstan-require-extends FluentAssertions
 */
trait BooleanAssertions
{
    /**
     * Asserts that a variable is true.
     * Uses strict comparison (variable === true).
     *
     * This method checks if the actual value is exactly the boolean true.
     *
     * Example usage:
     * fact(true)->true(); // Passes
     * fact(1)->true(); // Fails due to strict comparison
     *
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function true(string $message = ''): self
    {
        Assert::assertTrue($this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a variable is not true.
     * Uses strict comparison (variable !== true).
     *
     * This method checks if the actual value is not exactly the boolean true.
     *
     * Example usage:
     * fact(false)->notTrue(); // Passes
     * fact(true)->notTrue(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function notTrue(string $message = ''): self
    {
        Assert::assertNotTrue($this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a variable is false.
     * Uses strict comparison (variable === false).
     *
     * This method checks if the actual value is exactly the boolean false.
     *
     * Example usage:
     * fact(false)->false(); // Passes
     * fact(0)->false(); // Fails due to strict comparison
     *
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function false(string $message = ''): self
    {
        Assert::assertFalse($this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a variable is not false.
     * Uses strict comparison (variable !== false).
     *
     * This method checks if the actual value is not exactly the boolean false.
     *
     * Example usage:
     * fact(true)->notFalse(); // Passes
     * fact(false)->notFalse(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function notFalse(string $message = ''): self
    {
        Assert::assertNotFalse($this->variable, $message);

        return $this;
    }
}