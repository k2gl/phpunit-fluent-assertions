<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Null;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'notNull')]
final class NotNullTest extends FluentAssertionsTestCase
{
    public function testNull(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(null)->notNull();
    }

    #[DataProvider('notNullDataProvider')]
    public function testNotNull(mixed $variable): void
    {
        // act
        fact($variable)->notNull();

        // assert
        $this->correctAssertionExecuted();
    }

    public static function notNullDataProvider(): array
    {
        return [
            [true],
            [false],
            [0],
            [1],
            ['foo'],
            [['foo' => 'bar']],
            [(object) ['foo' => 'bar']],
            [fn() => false],
        ];
    }
}
