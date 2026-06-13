<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\HasValue;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\Tests\Fixtures\Status;
use PHPUnit\Framework\Attributes\CoversMethod;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'hasValue')]
final class HasValueTest extends FluentAssertionsTestCase
{
    public function testHasBackingValue(): void
    {
        // act
        fact(Status::Paid)->hasValue('paid');

        // assert
        $this->correctAssertionExecuted();
    }

    public function testFailsOnWrongValue(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(Status::Paid)->hasValue('pending');
    }

    public function testFailsWhenSubjectIsNotBackedEnum(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('paid')->hasValue('paid');
    }
}
