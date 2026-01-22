<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\JsonEquals;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'jsonEquals')]
final class JsonEqualsTest extends FluentAssertionsTestCase
{
    #[DataProvider('jsonEqualsDataProvider')]
    public function testJsonEquals(string $actual, string $expected): void
    {
        // act
        fact($actual)->jsonEquals($expected);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notJsonEqualsDataProvider')]
    public function testNotJsonEquals(string $actual, string $expected): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($actual)->jsonEquals($expected);
    }

    public static function jsonEqualsDataProvider(): array
    {
        return [
            ['{"key": "value"}', '{"key": "value"}'],
            ['[1, 2, 3]', '[1, 2, 3]'],
        ];
    }

    public static function notJsonEqualsDataProvider(): array
    {
        return [
            ['{"key": "value"}', '{"key": "different"}'],
            ['invalid json', '{"key": "value"}'], // invalid actual
            ['{"key": "value"}', 'invalid json'], // invalid expected
        ];
    }
}