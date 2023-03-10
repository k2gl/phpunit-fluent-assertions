<?php

namespace App\Tests\FluentAssertions\ContainsString;

use App\Tests\Lib\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notContainsString
 */
class NotContainsStringTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider notContainsStringDataProvider
     */
    public function testNotContainsString(string $variable, string $string): void
    {
        // act
        fact($variable)->notContainsString($string);

        // assert
        $this->correctAssertionExecuted();
    }

    public function testContainsString(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('alpha beta gamma')->notContainsString('beta');
    }

    private function notContainsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'echo'],
            ['alpha beta gamma', 'BETA'],
        ];
    }
}
