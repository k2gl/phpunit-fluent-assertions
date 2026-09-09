<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\JsonPath;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'jsonPath')]
final class JsonPathTest extends FluentAssertionsTestCase
{
    #[DataProvider('matchingDataProvider')]
    public function testJsonPath(string $variable, string $path, mixed $expected): void
    {
        // act
        fact($variable)->jsonPath($path, $expected);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notMatchingDataProvider')]
    public function testFailsWhenValueDiffersOrPathIsMissing(mixed $variable, string $path, mixed $expected): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->jsonPath($path, $expected);
    }

    public static function matchingDataProvider(): array
    {
        return [
            'top level key'   => ['{"id":42}', 'id', 42],
            'nested key'      => ['{"meta":{"total":3}}', 'meta.total', 3],
            'list position'   => ['{"data":[{"id":42}]}', 'data.0.id', 42],
            'root list'       => ['[10,20]', '1', 20],
            'null value'      => ['{"deleted_at":null}', 'deleted_at', null],
            'nested document' => ['{"a":{"b":[1,2]}}', 'a.b', [1, 2]],
        ];
    }

    public static function notMatchingDataProvider(): array
    {
        return [
            'different value'   => ['{"id":42}', 'id', 43],
            'strict comparison' => ['{"id":42}', 'id', '42'],
            'missing key'       => ['{"id":42}', 'name', 'Ada'],
            'missing branch'    => ['{"meta":{"total":3}}', 'meta.page.size', 1],
            'path into scalar'  => ['{"id":42}', 'id.0', 42],
            'dotted key'        => ['{"a.b":1}', 'a.b', 1],
            'invalid json'      => ['not json', 'id', 42],
            'not a string'      => [42, 'id', 42],
        ];
    }
}
