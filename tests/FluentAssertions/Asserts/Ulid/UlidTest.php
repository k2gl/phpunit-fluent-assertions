<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Ulid;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::ulid
 */
final class UlidTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider ulidDataProvider
     */
    public function testUlid(mixed $variable): void
    {
        // act
        fact($variable)->ulid();

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notUlidDataProvider
     */
    public function testNotUlid(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->ulid();
    }

    public static function ulidDataProvider(): array
    {
        return [
            ['01HJ38E3XC9KA5F2KM2K0RERXG'],
            ['01HAHAEN85YE39N0MPE3KSY25X'],
            ['71HAHAEN85YE39N0MPE3KSY25X'],
        ];
    }

    public static function notUlidDataProvider(): array
    {
        return [
            ['01hj38e3xc9ka5f2km2k0rerxg'],
            ['01HJ38E3XC9KA5F2KM2K0RERX'],
            ['1HJ38E3XC9KA5F2KM2K0RERXG'],
            ['81HJ38E3XC9KA5F2KM2K0RERXG'],
            [' 01HJ38E3XC9KA5F2KM2K0RERXG'],
            ['01HJ38E3XC9KA5F2KM2K0RERXG '],
        ];
    }
}
