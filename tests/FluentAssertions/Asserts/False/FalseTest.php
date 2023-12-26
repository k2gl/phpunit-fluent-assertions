<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\False;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::false
 */
final class FalseTest extends FluentAssertionsTestCase
{
    public function testFalse(): void
    {
        // act
        fact(false)->false();

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notFalseDataProvider
     */
    public function testNotFalse(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->false();
    }

    public static function notFalseDataProvider(): array
    {
        return [
            [null],
            [true],
            ['false'],
            [0],
            [1],
            ['0'],
            ['1'],
            [(object) ['foo' => 'bar']],
            [fn() => false],
        ];
    }
}
