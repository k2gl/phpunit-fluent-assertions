<?php declare(strict_types=1);

namespace App\Tests\FluentAssertions\Asserts\ContainsString;

use App\Tests\FluentAssertions\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::containsString
 */
final class ContainsStringTest extends FluentAssertionsTestCase
{
    public function testContainsString(): void
    {
        // act
        fact('alpha beta gamma')->containsString('beta');

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider notContainsStringDataProvider
     */
    public function testNotContainsString(string $variable, string $string): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->containsString($string);
    }

    private function notContainsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'echo'],
            ['alpha beta gamma', 'alphas'],
            ['alpha beta gamma', 'BETA'],
        ];
    }
}
