<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;

/**
 * @phpstan-require-extends FluentAssertions
 */
trait NullAssertions
{
    /**
     * Asserts that a variable is null.
     *
     * This method checks if the actual value is exactly null.
     *
     * Example usage:
     * fact(null)->null(); // Passes
     * fact('')->null(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self|fluentAssertions Enables fluent chaining of assertion methods.
     */
    public function null(string $message = ''): self
    {
        Assert::assertNull($this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a variable is not null.
     *
     * This method checks if the actual value is not null.
     *
     * Example usage:
     * fact(42)->notNull(); // Passes
     * fact(null)->notNull(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self|fluentAssertions Enables fluent chaining of assertion methods.
     */
    public function notNull(string $message = ''): self
    {
        Assert::assertNotNull($this->variable, $message);

        return $this;
    }
}