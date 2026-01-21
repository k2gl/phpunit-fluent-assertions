<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\HasSize;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'hasSize')]
final class HasSizeTest extends FluentAssertionsTestCase
{
    #[DataProvider('hasSizeDataProvider')]
    public function testHasSize(mixed $variable, mixed $size): void
    {
        // act
        fact($variable)->hasSize($size);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notHasSizeDataProvider')]
    public function testNotHasSize(mixed $variable, mixed $size): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->hasSize($size);
    }

    public static function hasSizeDataProvider(): array
    {
        return [
            [[1, 2], 2],
            [['a', 'b', 'c'], 3],
            [[], 0],
        ];
    }

    public static function notHasSizeDataProvider(): array
    {
        return [
            [[1, 2, 3], 2],
            [['a'], 3],
            [[1], 0],
        ];
    }
}