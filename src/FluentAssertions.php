<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions;

use K2gl\PHPUnitFluentAssertions\Traits\ArrayAssertions;
use K2gl\PHPUnitFluentAssertions\Traits\BooleanAssertions;
use K2gl\PHPUnitFluentAssertions\Traits\ComparisonAndEqualityAssertions;
use K2gl\PHPUnitFluentAssertions\Traits\NullAssertions;
use K2gl\PHPUnitFluentAssertions\Traits\NumericAssertions;
use K2gl\PHPUnitFluentAssertions\Traits\SpecialAssertions;
use K2gl\PHPUnitFluentAssertions\Traits\StringAssertions;
use K2gl\PHPUnitFluentAssertions\Traits\TypeCheckingAssertions;

class FluentAssertions
{
    use ComparisonAndEqualityAssertions;
    use BooleanAssertions;
    use NullAssertions;
    use NumericAssertions;
    use StringAssertions;
    use ArrayAssertions;
    use TypeCheckingAssertions;
    use SpecialAssertions;

    public function __construct(
        public readonly mixed $variable = null
    ) {
    }

    /**
     * Creates a new FluentAssertions instance for the given variable.
     *
     * This static method is a factory for starting fluent assertions on a variable.
     *
     * Example usage:
     * FluentAssertions::for($value)->is(42);
     *
     * @param mixed $variable The variable to assert on.
     *
     * @return self Returns a new FluentAssertions instance.
     */
    public static function for(mixed $variable = null): self
    {
        return new FluentAssertions(variable: $variable);
    }
}