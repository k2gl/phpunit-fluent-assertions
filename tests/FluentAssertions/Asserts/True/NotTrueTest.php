<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\True;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::notTrue
 */
final class NotTrueTest extends FluentAssertionsTestCase
{
    public function testTrue(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(true)->notTrue();
    }

    /**
     * @dataProvider notTrueDataProvider
     */
    public function testNotTrue(mixed $variable): void
    {
        // act
        fact($variable)->notTrue();

        // assert
        $this->correctAssertionExecuted();
    }

    public static function notTrueDataProvider(): array
    {
        return [
            [null],
            [false],
            [0],
            [1],
            ['0'],
            ['1'],
            [['foo' => 'bar'], ['foo' => 'bar']],
            [(object) ['foo' => 'bar']],
            [fn() => true],
        ];
    }
}
