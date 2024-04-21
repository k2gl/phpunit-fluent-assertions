<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\InstanceOf;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversMethod;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'instanceOf')]
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
