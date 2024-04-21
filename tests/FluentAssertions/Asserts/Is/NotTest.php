<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Is;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'not')]
final class NotTest extends FluentAssertionsTestCase
{
    #[DataProvider('notSameDataProvider')]
    public function testNotSame(mixed $variable, mixed $compare): void
    {
        // act
        fact($variable)->not($compare);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('sameDataProvider')]
    public function testSame(mixed $variable, mixed $compare): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->not($compare);
    }

    public static function notSameDataProvider(): array
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
            [fn() => false, fn() => false],
        ];
    }

    public static function sameDataProvider(): array
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
