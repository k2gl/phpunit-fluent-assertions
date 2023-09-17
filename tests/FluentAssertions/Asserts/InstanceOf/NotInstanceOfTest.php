<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\InstanceOf;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;

use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::notInstanceOf
 */
final class NotInstanceOfTest extends FluentAssertionsTestCase
{
    public function testIncorrectAssertion(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(new FluentAssertions())->notInstanceOf(FluentAssertions::class);
    }

    public function testCorrectAssertion(): void
    {
        // act
        fact(new FluentAssertions())->notInstanceOf(Assert::class);

        // assert
        $this->correctAssertionExecuted();
    }
}
