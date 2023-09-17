<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\InstanceOf;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;

use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::instanceOf
 */
final class InstanceOfTest extends FluentAssertionsTestCase
{
    public function testCorrectAssertion(): void
    {
        // act
        fact(new FluentAssertions())->instanceOf(FluentAssertions::class);

        // assert
        $this->correctAssertionExecuted();
    }

    public function testIncorrectAssertion(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(new FluentAssertions())->instanceOf(Assert::class);
    }
}
