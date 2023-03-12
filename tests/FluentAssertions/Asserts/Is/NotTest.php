<?php declare(strict_types=1);

namespace App\Tests\FluentAssertions\Asserts\Is;

use App\Tests\FluentAssertions\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::not
 */
final class NotTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider notSameDataProvider
     */
    public function testNotSame(mixed $variable, mixed $compare): void
    {
        // act
        fact($variable)->not($compare);

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider sameDataProvider
     */
    public function testSame(mixed $variable, mixed $compare): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->not($compare);
    }

    private function notSameDataProvider(): array
    {
        return [
            [null, false],
            [true, 1],
            [false, 0],
            [1, 2],
            ['0', 0],
            ['1', 1],
            ['foo', 'bar'],
            [['foo' => 'bar'], ['bar' => 'foo']],
            [(object) ['foo' => 'bar'], (object) ['foo' => 'bar']],
            [fn() => false, fn() => true],
        ];
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
}
