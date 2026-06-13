<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsEnum;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\Tests\Fixtures\Status;
use PHPUnit\Framework\Attributes\CoversMethod;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isEnum')]
final class IsEnumTest extends FluentAssertionsTestCase
{
    public function testIsExpectedCase(): void
    {
        // act
        fact(Status::Paid)->isEnum(Status::Paid);

        // assert
        $this->correctAssertionExecuted();
    }

    public function testFailsOnDifferentCase(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(Status::Paid)->isEnum(Status::Pending);
    }

    public function testFailsWhenSubjectIsBackingValue(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('paid')->isEnum(Status::Paid);
    }
}
