<?php

namespace App\Tests\FluentAssertions\ContainsString;

use k2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use function k2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \k2gl\PHPUnitFluentAssertions\FluentAssertions::notContainsString
 */
class NotContainsStringTest extends TestCase
{
    /**
     * @dataProvider notContainsStringDataProvider
     */
    public function testNotContainsString(string $variable, string $string): void
    {
        // act
        fact($variable)->notContainsString($string);

        // assert
        self::assertSame(expected: 1, actual: Assert::getCount());
    }

    public function testContainsString(): void
    {
        // assert
        $this->expectException(ExpectationFailedException::class);

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
