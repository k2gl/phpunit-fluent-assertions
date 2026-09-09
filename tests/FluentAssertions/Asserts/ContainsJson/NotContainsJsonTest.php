<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\ContainsJson;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'notContainsJson')]
final class NotContainsJsonTest extends FluentAssertionsTestCase
{
    #[DataProvider('notContainingDataProvider')]
    public function testNotContainsJson(string $variable, string|array $expected): void
    {
        // act
        fact($variable)->notContainsJson($expected);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('containingDataProvider')]
    public function testFailsWhenSubsetIsPresent(string $variable, string|array $expected): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->notContainsJson($expected);
    }

    public static function notContainingDataProvider(): array
    {
        return [
            'different value' => ['{"id":42}', ['id' => 43]],
            'missing key'     => ['{"id":42}', ['name' => 'Ada']],
            'nested mismatch' => ['{"data":{"id":42}}', ['data' => ['id' => 43]]],
        ];
    }

    public static function containingDataProvider(): array
    {
        return [
            'present subset'      => ['{"id":42,"name":"Ada"}', ['id' => 42]],
            'expectation as json' => ['{"id":42,"name":"Ada"}', '{"name":"Ada"}'],
        ];
    }
}
