<?php declare(strict_types=1);

namespace App\Tests\FluentAssertions\Asserts\ContainsString;

use App\Tests\FluentAssertions\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notContainsString
 */
final class NotContainsStringTest extends FluentAssertionsTestCase
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
