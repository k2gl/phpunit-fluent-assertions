<?php

namespace App\Tests\FluentAssertions\False;

use App\Tests\Lib\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notFalse
 */
class NotFalseTest extends FluentAssertionsTestCase
{
    public function testFalse(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(false)->notFalse();
    }

    /**
     * @dataProvider notFalseDataProvider
     */
    public function testNotFalse(mixed $variable): void
    {
        // act
        fact($variable)->notFalse();

        // assert
        $this->correctAssertionExecuted();
    }

    private function notFalseDataProvider(): array
    {
        return [
            [null],
            [true],
            [0],
            [1],
            ['0'],
            ['1'],
            [['foo' => 'bar'], ['foo' => 'bar']],
            [(object) ['foo' => 'bar']],
            [fn() => false],
        ];
    }
}
