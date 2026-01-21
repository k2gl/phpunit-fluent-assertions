<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Reference\RegularExpressionPattern;

/**
 * @phpstan-require-extends FluentAssertions
 */
trait SpecialAssertions
{
    /**
     * Asserts that a variable is a valid ULID.
     *
     * This method checks if the actual value matches the ULID (Universally Unique Lexicographically Sortable Identifier) format.
     *
     * @see https://github.com/ulid/spec
     *
     * Example usage:
     * fact('01ARZ3NDEKTSV4RRFFQ69G5FAV')->ulid(); // Passes (if valid ULID)
     * fact('invalid-ulid')->ulid(); // Fails
     *
     * @return self|fluentAssertions Enables fluent chaining of assertion methods.
     */
    public function ulid(): self
    {
        return $this->matchesRegularExpression(RegularExpressionPattern::ULID);
    }
}