<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Equals;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::equals
 */
final class EqualsTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider equalsDataProvider
     */
    public function testEquals(mixed $variable, mixed $compare): void
    {
        // act
        fact($variable)->equals($compare);

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notEqualsDataProvider
     */
    public function testNotEquals(mixed $variable, mixed $compare): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->equals($compare);
    }

    public static function equalsDataProvider(): array
    {
        return [
            [null, null],
            [null, false],
            [null, 0],
            [true, true],
            [true, 'true'],
            [true, 1],
            [1, 1],
            [1, '1'],
            ['foo', 'foo'],
            [['foo' => 'bar'], ['foo' => 'bar']],
            [['foo' => 'bar', 'miss' => 'kiss'], ['miss' => 'kiss', 'foo' => 'bar']],
            [$object = (object) ['foo' => 'bar'], $object],
            [(object) ['miss' => 'kiss'], (object) ['miss' => 'kiss']],
            [(object) ['miss' => 'kiss', 'foo' => 'bar'], (object) ['foo' => 'bar', 'miss' => 'kiss']],
            [fn() => false, fn() => true],
        ];
    }

    public static function notEqualsDataProvider(): array
    {
        return [
            [null, true],
            [null, 'true'],
            [null, 1],
            [false, true],
            [false, 'true'],
            [false, 1],
            [true, null],
            [true, false],
            [true, 0],
            [1, 2],
            [2, '1'],
            ['miss', 'kiss'],
            [['miss' => 'kiss'], ['kiss' => 'miss']],
            [['foo' => 'bar', 'miss' => 'kiss'], ['foo' => 'bar', 'kiss' => 'miss']],
            [(object) ['miss' => 'kiss'], (object) ['kiss' => 'miss']],
            [(object) ['miss' => 'kiss', 'foo' => 'bar'], (object) ['miss' => 'kiss', 'bar' => 'foo']],
            [fn() => false, null],
            [fn() => false, false],
            [fn() => false, true],
            [fn() => false, (object) ['foo' => 'bar']],
        ];
    }
}
