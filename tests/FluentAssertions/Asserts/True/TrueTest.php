<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\True;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::true
 */
final class TrueTest extends FluentAssertionsTestCase
{
    public function testTrue(): void
    {
        // act
        fact(true)->true();

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notTrueDataProvider
     */
    public function testNotTrue(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->true();
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
            ['foo'],
            [(object) ['foo' => 'bar']],
            [fn() => null],
        ];
    }
}
