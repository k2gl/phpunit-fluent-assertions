<?php

namespace k2gl\PHPUnitFluentAssertions;

function check(mixed $value): FluentAssertions
{
    return FluentAssertions::for($value);
}

function expect(mixed $value): FluentAssertions
{
    return FluentAssertions::for($value);
}

function fact(mixed $value): FluentAssertions
{
    return FluentAssertions::for($value);
}