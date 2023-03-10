<?php

namespace App\Tests\FluentAssertions;

use function k2gl\PHPUnitFluentAssertions\check;
use function k2gl\PHPUnitFluentAssertions\expect;
use function k2gl\PHPUnitFluentAssertions\fact;

final class AliasesTest extends FluentAssertionsTestCase
{
    public function testCheckMethod(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $fluentAssertions = check(variable: $variable);

        // assert
        $this->hasExpectedVariable(fluentAssertions: $fluentAssertions, expected: $variable);
    }

    public function testExpectMethod(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $fluentAssertions = expect(variable: $variable);

        // assert
        $this->hasExpectedVariable(fluentAssertions: $fluentAssertions, expected: $variable);
    }

    public function testFactMethod(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $fluentAssertions = fact(variable: $variable);

        // assert
        $this->hasExpectedVariable(fluentAssertions: $fluentAssertions, expected: $variable);
    }
}
