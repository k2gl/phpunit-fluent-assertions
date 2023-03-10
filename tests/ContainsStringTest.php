<?php

namespace App\Tests;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::containsString
 */
class ContainsStringTest extends TestCase
{
    public function testContainsString(): void
    {
        // act
        fact('alpha beta gamma')->containsString('beta');

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    /**
     * @dataProvider notContainsStringDataProvider
     */
    public function testNotContainsString(string $variable, string $string): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

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
