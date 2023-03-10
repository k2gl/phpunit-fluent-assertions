<?php

namespace App\Tests\FluentAssertions\Null;

use App\Tests\Lib\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notNull
 */
class NotNullTest extends FluentAssertionsTestCase
{
    public function testNull(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(null)->notNull();
    }

    /**
     * @dataProvider notNullDataProvider
     */
    public function testNotNull(mixed $variable): void
    {
        // act
        fact($variable)->notNull();

        // assert
        $this->correctAssertionExecuted();
    }

    private function notNullDataProvider(): array
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
