<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\DoesNotContain;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'doesNotContain')]
final class DoesNotContainTest extends FluentAssertionsTestCase
{
    #[DataProvider('doesNotContainDataProvider')]
    public function testDoesNotContain(mixed $variable, mixed $value): void
    {
        // act
        fact($variable)->doesNotContain($value);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notDoesNotContainDataProvider')]
    public function testNotDoesNotContain(mixed $variable, mixed $value): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->doesNotContain($value);
    }

    public static function doesNotContainDataProvider(): array
    {
        return [
            [[1, 2], 3],
            [['a', 'b'], 'c'],
            [[], 1],
        ];
    }

    public static function notDoesNotContainDataProvider(): array
    {
        return [
            [[1, 2, 3], 2],
            [['a', 'b'], 'a'],
            [[1], 1],
        ];
    }
}