<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsJson;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isJson')]
final class IsJsonTest extends FluentAssertionsTestCase
{
    #[DataProvider('isJsonDataProvider')]
    public function testIsJson(mixed $variable): void
    {
        // act
        fact($variable)->isJson();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsJsonDataProvider')]
    public function testNotIsJson(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isJson();
    }

    public static function isJsonDataProvider(): array
    {
        return [
            ['{"key": "value"}'],
            ['[1, 2, 3]'],
            ['"string"'],
            ['42'],
            ['true'],
        ];
    }

    public static function notIsJsonDataProvider(): array
    {
        return [
            ['invalid json'],
            ['{key: value}'],
            [''],
            ['not json'],
        ];
    }
}