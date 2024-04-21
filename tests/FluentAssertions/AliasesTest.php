<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions;

use PHPUnit\Framework\Attributes\CoversFunction;

use function K2gl\PHPUnitFluentAssertions\check;
use function K2gl\PHPUnitFluentAssertions\expect;
use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversFunction('K2gl\PHPUnitFluentAssertions\check')]
#[CoversFunction('K2gl\PHPUnitFluentAssertions\expect')]
#[CoversFunction('K2gl\PHPUnitFluentAssertions\fact')]
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
