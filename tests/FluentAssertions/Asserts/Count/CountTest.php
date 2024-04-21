<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\Count;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'count')]
final class CountTest extends FluentAssertionsTestCase
{
    #[DataProvider('expectedCountDataProvider')]
    public function testExpectedCount(array $variable, int $expectedCount): void
    {
        // act
        fact($variable)->count($expectedCount);

        // assert
        $this->correctAssertionExecuted();
    }

    public function testNotExpectedCount(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact(['alpha', 'beta', 'gamma'])->count(44);
    }

    public static function expectedCountDataProvider(): array
    {
        return [
            [[], 0],
            [['alpha', 'beta', 'gamma'], 3],
            [['alpha' => ['beta', 'gamma']], 1],
        ];
    }
}
