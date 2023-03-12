<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions;

function check(mixed $variable = null): FluentAssertions
{
    return FluentAssertions::for($variable);
}

function expect(mixed $variable = null): FluentAssertions
{
    return FluentAssertions::for($variable);
}

function fact(mixed $variable = null): FluentAssertions
{
    return FluentAssertions::for($variable);
}