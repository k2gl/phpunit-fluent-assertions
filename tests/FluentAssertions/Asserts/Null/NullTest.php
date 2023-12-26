<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Null;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::null
 */
final class NullTest extends FluentAssertionsTestCase
{
    public function testNull(): void
    {
        // act
        fact(null)->null();

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notNullDataProvider
     */
    public function testNotNull(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->null();
    }

    public static function notNullDataProvider(): array
    {
        return [
            [true],
            [1],
            ['foo'],
            [['foo' => 'bar']],
            [(object) ['foo' => 'bar']],
            [fn() => false],
        ];
    }
}
