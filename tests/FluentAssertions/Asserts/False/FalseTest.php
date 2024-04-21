<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\False;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'false')]
final class FalseTest extends FluentAssertionsTestCase
{
    public function testFalse(): void
    {
        // act
        fact(false)->false();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notFalseDataProvider')]
    public function testNotFalse(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->false();
    }

    public static function notFalseDataProvider(): array
    {
        return [
            [null],
            [true],
            ['false'],
            [0],
            [1],
            ['0'],
            ['1'],
            [(object) ['foo' => 'bar']],
            [static fn(): bool => false],
        ];
    }
}
