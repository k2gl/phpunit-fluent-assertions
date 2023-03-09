<?php
declare(strict_types=1);

namespace k2gl\PHPUnitFluentAssertions;

use PHPUnit\Framework\Assert;

class FluentAssertions
{
    public function __construct(
        public readonly mixed $variable
    ) {
    }

    public static function for(mixed $variable): self
    {
        return new FluentAssertions(variable: $variable);
    }

    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference
     * the same object.
     */
    public function is(mixed $expected, string $message = ''): self
    {
        Assert::assertSame(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that two variables do not have the same type and value.
     * Used on objects, it asserts that two variables do not reference
     * the same object.
     */
    public function not(mixed $expected, string $message = ''): self
    {
        Assert::assertNotSame(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is true.
     * Use strict comparison (variable === true).
     */
    public function true(string $message = ''): self
    {
        Assert::assertTrue(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not true.
     * Use strict comparison (variable !== true).
     */
    public function notTrue(string $message = ''): self
    {
        Assert::assertNotTrue(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is false.
     * Use strict comparison (variable === false).
     */
    public function false(string $message = ''): self
    {
        Assert::assertFalse(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not true.
     * Use strict comparison (variable !== false).
     */
    public function notFalse(string $message = ''): self
    {
        Assert::assertNotFalse(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is null.
     */
    public function null(string $message = ''): self
    {
        Assert::assertNull(actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not null.
     */
    public function notNull(string $message = ''): self
    {
        Assert::assertNotNull(actual: $this->variable, message: $message);

        return $this;
    }

}
