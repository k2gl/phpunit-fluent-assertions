<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\EndsWith;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'endsWith')]
final class EndsWithTest extends FluentAssertionsTestCase
{
    #[DataProvider('endsWithDataProvider')]
    public function testEndsWith(mixed $variable, mixed $suffix): void
    {
        // act
        fact($variable)->endsWith($suffix);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notEndsWithDataProvider')]
    public function testNotEndsWith(mixed $variable, mixed $suffix): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->endsWith($suffix);
    }

    public static function endsWithDataProvider(): array
    {
        return [
            ['file.txt', '.txt'],
            ['test string', 'string'],
            ['abc', 'c'],
        ];
    }

    public static function notEndsWithDataProvider(): array
    {
        return [
            ['txt.file', '.txt'],
            ['string test', 'string'],
            ['abc', 'b'],
        ];
    }
}