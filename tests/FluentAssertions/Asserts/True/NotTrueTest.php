<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\True;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'notTrue')]
final class NotTrueTest extends FluentAssertionsTestCase
{
    public function testTrue(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(true)->notTrue();
    }

    #[DataProvider('notTrueDataProvider')]
    public function testNotTrue(mixed $variable): void
    {
        // act
        fact($variable)->notTrue();

        // assert
        $this->correctAssertionExecuted();
    }

    public static function notTrueDataProvider(): array
    {
        return [
            [null],
            [false],
            [0],
            [1],
            ['0'],
            ['1'],
            [['foo' => 'bar2']],
            [(object) ['foo' => 'bar']],
            [static fn(): bool => true],
        ];
    }
}
