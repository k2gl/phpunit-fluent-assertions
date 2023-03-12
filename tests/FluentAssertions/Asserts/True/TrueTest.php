<?php declare(strict_types=1);

namespace App\Tests\FluentAssertions\Asserts\True;

use App\Tests\FluentAssertions\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::true
 */
final class TrueTest extends FluentAssertionsTestCase
{
    public function testTrue(): void
    {
        // act
        fact(true)->true();

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notTrueDataProvider
     */
    public function testNotTrue(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->true();
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
            ['foo'],
            [(object) ['foo' => 'bar']],
            [fn() => null],
        ];
    }
}
