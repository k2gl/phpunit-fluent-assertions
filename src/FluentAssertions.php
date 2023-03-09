<?php
declare(strict_types=1);

namespace k2gl\PHPUnitFluentAssertions;

use PHPUnit\Framework\Assert;

class FluentAssertions
{
    public function __construct(
        public readonly mixed $data
    ) {
    }

    public static function for(mixed $data): self
    {
        return new FluentAssertions($data);
    }

    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference
     * the same object.
     */
    public function is(mixed $expected, string $message = ''): self
    {
        Assert::assertSame($expected, $this->data, $message);

        return $this;
    }

    /**
     * Asserts that two variables do not have the same type and value.
     * Used on objects, it asserts that two variables do not reference
     * the same object.
     */
    public function not(mixed $expected, string $message = ''): self
    {
        Assert::assertNotSame($expected, $this->data, $message);

        return $this;
    }

    /**
     * Asserts that a condition is true. Use strict comparison (value === true).
     */
    public function true(string $message = ''): self
    {
        Assert::assertTrue($this->data, $message);

        return $this;
    }

    /**
     * Asserts that a condition is false. Use strict comparison (value === false).
     */
    public function false(string $message = ''): self
    {
        Assert::assertFalse($this->data, $message);

        return $this;
    }

    /**
     * Asserts that a variable is null.
     */
    public function null(string $message = ''): self
    {
        Assert::assertNull($this->data, $message);

        return $this;
    }

    /**
     * Asserts that a variable is not null.
     */
    public function notNull(string $message = ''): self
    {
        Assert::assertNotNull($this->data, $message);

        return $this;
    }

}
