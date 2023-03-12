<?php declare(strict_types=1);

namespace App\Tests\FluentAssertions\Asserts\True;

use App\Tests\FluentAssertions\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notTrue
 */
final class NotTrueTest extends FluentAssertionsTestCase
{
    public function testTrue(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(true)->notTrue();
    }

    /**
     * @dataProvider notTrueDataProvider
     */
    public function testNotTrue(mixed $variable): void
    {
        // act
        fact($variable)->notTrue();

        // assert
        $this->correctAssertionExecuted();
    }

    private function notTrueDataProvider(): array
    {
        return [
            [null],
            [false],
            [0],
            [1],
            ['0'],
            ['1'],
            [['foo' => 'bar'], ['foo' => 'bar']],
            [(object) ['foo' => 'bar']],
            [fn() => true],
        ];
    }
}
