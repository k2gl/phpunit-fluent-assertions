<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions;

use function K2gl\PHPUnitFluentAssertions\check;
use function K2gl\PHPUnitFluentAssertions\expect;
use function K2gl\PHPUnitFluentAssertions\fact;

final class AliasesTest extends FluentAssertionsTestCase
{
    /** @covers \K2gl\PHPUnitFluentAssertions\check */
    public function testCheckMethod(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $fluentAssertions = check(variable: $variable);

        // assert
        $this->hasExpectedVariable(fluentAssertions: $fluentAssertions, expected: $variable);
    }

    /** @covers \K2gl\PHPUnitFluentAssertions\expect */
    public function testExpectMethod(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $fluentAssertions = expect(variable: $variable);

        // assert
        $this->hasExpectedVariable(fluentAssertions: $fluentAssertions, expected: $variable);
    }

    /** @covers \K2gl\PHPUnitFluentAssertions\fact */
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
