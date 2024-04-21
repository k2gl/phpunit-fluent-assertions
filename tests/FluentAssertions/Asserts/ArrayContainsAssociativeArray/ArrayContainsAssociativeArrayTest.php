<?php

declare(strict_types=1);

namespace FluentAssertions\Asserts\ArrayContainsAssociativeArray;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'arrayContainsAssociativeArray')]
final class ArrayContainsAssociativeArrayTest extends FluentAssertionsTestCase
{
    #[DataProvider('arrayContainsDataProvider')]
    public function testArrayContains1111(array $data, array $values): void
    {
        // act
        fact($data)->arrayContainsAssociativeArray($values);

        // assert
        $this->correctAssertionExecuted();
    }

    public static function arrayContainsDataProvider(): array
    {
        return [
            ['data' => [], 'values' => []],
            ['data' => ['one'], 'values' => ['one']],
            ['data' => ['one', 'two'], 'values' => ['one']],
            ['data' => ['one' => 'two', 'three'], 'values' => ['one' => 'two']],
            ['data' => ['one' => 'two', 'three' => 'four'], 'values' => ['one' => 'two']],
            ['data' => ['items' => ['one', 'two']], 'values' => ['items' => ['one', 'two']]],
            ['data' => ['items' => ['one', 'two', 'three']], 'values' => ['items' => ['one', 'two']]],
            ['data' => ['items' => ['one', 'two', 'three']], 'values' => ['items' => ['one', 'two', 'three']]],
            [
                'data' => ['a' => ['1', '2' => ['00' => '00', '11' => '111', '22' => '222'], '3']],
                'values' => ['a' => ['2' => ['11' => '111']]],
            ],
            [
                'data' => ['a' => ['type' => 'candy', 'color' => 'red'], 'b' => ['miss' => 'kiss', 'foo' => 'bar']],
                'values' => ['b' => ['foo' => 'bar', 'miss' => 'kiss'], 'a' => ['color' => 'red']],
            ],
        ];
    }

    #[DataProvider('arrayNotContainsDataProvider')]
    public function testArrayNotContains2222(mixed $data, mixed $values): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($data)->arrayContainsAssociativeArray($values);
    }

    public static function arrayNotContainsDataProvider(): array
    {
        return [
            ['data' => ['one' => 'two'], 'values' => ['one' => 'three']],
            ['data' => ['items' => ['one', 'two']], 'values' => ['items' => ['two', 'one']]],
            [
                'data' => ['a' => ['type' => 'candy', 'color' => 'red'], 'b' => ['miss' => 'kiss', 'foo' => 'bar']],
                'values' => ['b' => ['foo' => 'bar', 'miss' => 'kiss'], 'a' => ['color' => 'green']],
            ],
        ];
    }
}
