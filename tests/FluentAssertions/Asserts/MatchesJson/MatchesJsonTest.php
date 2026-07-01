<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\MatchesJson;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'matchesJson')]
final class MatchesJsonTest extends FluentAssertionsTestCase
{
    #[DataProvider('matchingDataProvider')]
    public function testMatchesJson(string $variable, string $expectedJson): void
    {
        // act
        fact($variable)->matchesJson($expectedJson);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notMatchingDataProvider')]
    public function testFailsWhenDifferentOrInvalid(string $variable, string $expectedJson): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->matchesJson($expectedJson);
    }

    public static function matchingDataProvider(): array
    {
        return [
            'object key order ignored' => ['{"a":1,"b":2}', '{"b":2,"a":1}'],
            'whitespace ignored'       => ['{"a":  1 }', '{"a":1}'],
            'nested structure'         => ['{"a":{"x":[1,2]}}', '{"a":{"x":[1,2]}}'],
            'scalar'                   => ['42', '42'],
        ];
    }

    public static function notMatchingDataProvider(): array
    {
        return [
            'different value'  => ['{"a":1}', '{"a":2}'],
            'array order'      => ['[1,2]', '[2,1]'],
            'invalid actual'   => ['not json', '{}'],
            'invalid expected' => ['{}', 'not json'],
        ];
    }
}
