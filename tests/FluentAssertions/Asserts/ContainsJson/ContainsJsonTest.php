<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\ContainsJson;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'containsJson')]
final class ContainsJsonTest extends FluentAssertionsTestCase
{
    #[DataProvider('containingDataProvider')]
    public function testContainsJson(string $variable, string|array $expected): void
    {
        // act
        fact($variable)->containsJson($expected);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notContainingDataProvider')]
    public function testFailsWhenSubsetIsAbsentOrInvalid(mixed $variable, mixed $expected): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->containsJson($expected);
    }

    public static function containingDataProvider(): array
    {
        return [
            'volatile fields ignored' => ['{"id":42,"created_at":"2026-01-01"}', ['id' => 42]],
            'expectation as json'     => ['{"id":42,"name":"Ada"}', '{"id":42}'],
            'nested subset'           => ['{"data":{"id":42,"role":"admin"}}', ['data' => ['id' => 42]]],
            'list prefix'             => ['{"tags":["a","b","c"]}', ['tags' => ['a', 'b']]],
            'empty subset'            => ['{"id":42}', []],
            'null value'              => ['{"deleted_at":null}', ['deleted_at' => null]],
        ];
    }

    public static function notContainingDataProvider(): array
    {
        return [
            'different value'  => ['{"id":42}', ['id' => 43]],
            'loose comparison' => ['{"id":42}', ['id' => '42']],
            'missing key'      => ['{"id":42}', ['name' => 'Ada']],
            'list order'       => ['{"tags":["a","b"]}', ['tags' => ['b']]],
            'nested mismatch'  => ['{"data":{"id":42}}', ['data' => ['id' => 43]]],
            'invalid actual'   => ['not json', ['id' => 42]],
            'invalid expected' => ['{"id":42}', 'not json'],
            'scalar document'  => ['42', ['id' => 42]],
            'scalar subset'    => ['{"id":42}', '42'],
            'subject not string' => [42, ['id' => 42]],
        ];
    }
}
