<?php

namespace App\Tests\FluentAssertions\Is;

use App\Tests\Lib\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::is
 */
class IsTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider sameDataProvider
     */
    public function testSame(mixed $variable, mixed $compare): void
    {
        // act
        fact($variable)->is($compare);

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notSameDataProvider
     */
    public function testNotSame(mixed $variable, mixed $compare): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->is($compare);
    }

    private function sameDataProvider(): array
    {
        return [
            [null, null],
            [true, true],
            [false, false],
            [1, 1],
            ['0', '0'],
            ['foo', 'foo'],
            [['foo' => 'bar'], ['foo' => 'bar']],
            [$object = (object) ['foo' => 'bar'], $object],
            [$fn = fn() => false, $fn],
        ];
    }

    private function notSameDataProvider(): array
    {
        return [
            [null, false],
            [null, 0],
            [true, 1],
            [false, 0],
            [1, 2],
            ['0', 0],
            ['1', 1],
            ['foo', 'baz'],
            [['foo' => 'bar'], ['bar' => 'foo']],
            [(object) ['foo' => 'bar'], (object) ['foo' => 'bar']],
            [fn() => false, fn() => true],
        ];
    }
}
