<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\MatchesJson;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'notMatchesJson')]
final class NotMatchesJsonTest extends FluentAssertionsTestCase
{
    #[DataProvider('differingDataProvider')]
    public function testNotMatchesJson(string $variable, string $expectedJson): void
    {
        // act
        fact($variable)->notMatchesJson($expectedJson);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('equalOrInvalidDataProvider')]
    public function testFailsWhenEqualOrInvalid(string $variable, string $expectedJson): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->notMatchesJson($expectedJson);
    }

    public static function differingDataProvider(): array
    {
        return [
            'different value' => ['{"a":1}', '{"a":2}'],
            'array order'     => ['[1,2]', '[2,1]'],
        ];
    }

    public static function equalOrInvalidDataProvider(): array
    {
        return [
            'equal ignoring key order' => ['{"a":1,"b":2}', '{"b":2,"a":1}'],
            'invalid actual'           => ['not json', '{}'],
        ];
    }
}
