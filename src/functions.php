<?php

namespace k2gl\PHPUnitFluentAssertions;

function check(mixed $variable): FluentAssertions
{
    return FluentAssertions::for($variable);
}

function expect(mixed $variable): FluentAssertions
{
    return FluentAssertions::for($variable);
}

function fact(mixed $variable): FluentAssertions
{
    return FluentAssertions::for($variable);
}