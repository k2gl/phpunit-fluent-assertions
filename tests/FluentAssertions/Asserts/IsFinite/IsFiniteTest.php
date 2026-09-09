<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsFinite;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isFinite')]
final class IsFiniteTest extends FluentAssertionsTestCase
{
    #[DataProvider('isFiniteDataProvider')]
    public function testIsFinite(mixed $variable): void
    {
        // act
        fact($variable)->isFinite();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsFiniteDataProvider')]
    public function testNotIsFinite(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isFinite();
    }

    public static function isFiniteDataProvider(): array
    {
        return [
            'int'        => [42],
            'float'      => [1.5],
            'zero'       => [0.0],
            'huge float' => [1.0e308],
        ];
    }

    public static function notIsFiniteDataProvider(): array
    {
        return [
            'infinity'          => [INF],
            'negative infinity' => [-INF],
            'nan'               => [NAN],
            'numeric string'    => ['1.5'],
        ];
    }
}
