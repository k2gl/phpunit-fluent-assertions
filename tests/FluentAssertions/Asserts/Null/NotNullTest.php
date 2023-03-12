<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Null;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\PHPUnitFluentAssertions\FluentAssertions::notNull
 */
final class NotNullTest extends FluentAssertionsTestCase
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
