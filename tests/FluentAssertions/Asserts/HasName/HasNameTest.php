<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\HasName;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\Tests\Fixtures\Status;
use PHPUnit\Framework\Attributes\CoversMethod;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'hasName')]
final class HasNameTest extends FluentAssertionsTestCase
{
    public function testHasCaseName(): void
    {
        // act
        fact(Status::Paid)->hasName('Paid');

        // assert
        $this->correctAssertionExecuted();
    }

    public function testFailsOnWrongName(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(Status::Paid)->hasName('Pending');
    }

    public function testFailsWhenSubjectIsNotEnum(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('Paid')->hasName('Paid');
    }
}
