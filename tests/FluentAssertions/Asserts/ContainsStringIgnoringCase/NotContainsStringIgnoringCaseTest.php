<?php declare(strict_types=1);

namespace App\Tests\FluentAssertions\Asserts\ContainsStringIgnoringCase;

use App\Tests\FluentAssertions\FluentAssertionsTestCase;
use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notContainsStringIgnoringCase
 */
final class NotContainsStringIgnoringCaseTest extends FluentAssertionsTestCase
{
    /**
     * @dataProvider notContainsStringDataProvider
     */
    public function testNotContainsStringIgnoringCase(string $variable, string $string): void
    {
        // act
        fact($variable)->notContainsStringIgnoringCase($string);

        // assert
        $this->correctAssertionExecuted();
    }

    /**
     * @dataProvider containsStringDataProvider
     */
    public function testContainsStringIgnoringCase(string $variable, string $string): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->notContainsStringIgnoringCase($string);
    }

    private function containsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'beta'],
            ['alpha beta gamma', 'BETA'],
            ['alpha beta gamma', 'BeTa'],
        ];
    }

    private function notContainsStringDataProvider(): array
    {
        return [
            ['alpha beta gamma', 'echo'],
            ['alpha beta gamma', 'ECHO'],
        ];
    }
}
