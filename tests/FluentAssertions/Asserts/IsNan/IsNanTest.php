<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsNan;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isNan')]
final class IsNanTest extends FluentAssertionsTestCase
{
    public function testIsNan(): void
    {
        // act
        fact(NAN)->isNan();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsNanDataProvider')]
    public function testNotIsNan(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isNan();
    }

    public static function notIsNanDataProvider(): array
    {
        return [
            'float'    => [1.0],
            'infinity' => [INF],
            'int'      => [0],
            'string'   => ['NAN'],
        ];
    }
}
