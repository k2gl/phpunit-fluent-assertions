<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use BackedEnum;
use PHPUnit\Framework\Assert;
use UnitEnum;

/**
 * Soft integration with enums — works on any native UnitEnum / BackedEnum,
 * without depending on k2gl/enum.
 *
 * @phpstan-require-extends \K2gl\PHPUnitFluentAssertions\FluentAssertions
 */
trait EnumAssertions
{
    /**
     * Asserts that the subject is the given enum case (identity).
     *
     * Example usage:
     * fact($order->status)->isEnum(Status::Paid);
     */
    public function isEnum(UnitEnum $case, string $message = ''): self
    {
        Assert::assertSame($case, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that the subject is a BackedEnum whose backing value equals `$value`.
     */
    public function hasValue(int|string $value, string $message = ''): self
    {
        $subject = $this->variable;

        if (! $subject instanceof BackedEnum) {
            Assert::fail('hasValue() expects the subject to be a BackedEnum.');
        }

        Assert::assertSame($value, $subject->value, $message);

        return $this;
    }

    /**
     * Asserts that the subject is an enum whose case name equals `$name`.
     */
    public function hasName(string $name, string $message = ''): self
    {
        $subject = $this->variable;

        if (! $subject instanceof UnitEnum) {
            Assert::fail('hasName() expects the subject to be an enum.');
        }

        Assert::assertSame($name, $subject->name, $message);

        return $this;
    }
}
