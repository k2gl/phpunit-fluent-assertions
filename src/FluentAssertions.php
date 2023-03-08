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

    public function is(mixed $expected): self
    {
        Assert::assertSame($expected, $this->data);

        return $this;
    }

    public function not(mixed $expected): self
    {
        Assert::assertNotSame($expected, $this->data);

        return $this;
    }
}
