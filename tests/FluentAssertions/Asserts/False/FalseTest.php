<?php declare(strict_types=1);

namespace App\Tests\FluentAssertions\Asserts\False;

use App\Tests\FluentAssertions\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::false
 */
final class FalseTest extends FluentAssertionsTestCase
{
    public function testFalse(): void
    {
        // act
        fact(false)->false();

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notFalseDataProvider
     */
    public function testNotFalse(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->false();
    }

    private function notFalseDataProvider(): array
    {
        return [
            [null],
            [true],
            [0],
            [1],
            ['0'],
            ['1'],
            [(object) ['foo' => 'bar']],
            [fn() => false],
        ];
    }
}
