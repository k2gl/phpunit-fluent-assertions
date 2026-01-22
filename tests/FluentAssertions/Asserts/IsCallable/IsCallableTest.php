<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsCallable;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isCallable')]
final class IsCallableTest extends FluentAssertionsTestCase
{
    #[DataProvider('isCallableDataProvider')]
    public function testIsCallable(mixed $variable): void
    {
        // act
        fact($variable)->isCallable();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsCallableDataProvider')]
    public function testNotIsCallable(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isCallable();
    }

    public static function isCallableDataProvider(): array
    {
        return [
            ['strlen'],
            [fn() => true],
        ];
    }

    public static function notIsCallableDataProvider(): array
    {
        return [
            ['string'],
            [42],
            [true],
            [null],
            [[]],
        ];
    }
}