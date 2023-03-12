<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions
 */
final class ConstructorsTest extends FluentAssertionsTestCase
{
    public function testConstructor(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $fluentAssertions = new FluentAssertions(variable: $variable);

        // assert
        $this->hasExpectedVariable(fluentAssertions: $fluentAssertions, expected: $variable);
    }

    public function testStaticConstructor(): void
    {
        // arrange
        $variable = random_bytes(16);

        // act
        $fluentAssertions = FluentAssertions::for(variable: $variable);

        // assert
        $this->hasExpectedVariable(fluentAssertions: $fluentAssertions, expected: $variable);
    }
}
