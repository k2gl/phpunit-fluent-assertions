<?php

namespace App\Tests\FluentAssertions\Null;

use App\Tests\Lib\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::null
 */
class NullTest extends FluentAssertionsTestCase
{
    public function testNull(): void
    {
        // act
        fact(null)->null();

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notNullDataProvider
     */
    public function testNotNull(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->null();
    }

    private function notNullDataProvider(): array
    {
        return [
            [true],
            [1],
            ['foo'],
            [['foo' => 'bar']],
            [(object) ['foo' => 'bar']],
            [fn() => false],
        ];
    }
}
