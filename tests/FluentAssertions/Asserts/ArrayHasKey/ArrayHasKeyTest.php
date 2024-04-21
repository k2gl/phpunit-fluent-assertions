<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\ArrayHasKey;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'arrayHasKey')]
final class ArrayHasKeyTest extends FluentAssertionsTestCase
{
    #[DataProvider('notHasKeyDataProvider')]
    public function testFailArrayNotHasKey(array $variable, int|string $key): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->arrayHasKey($key);
    }

    public function testHasKey(): void
    {
        // act
        fact(['alpha' => 'beta'])->arrayHasKey('alpha');

        // assert
        $this->correctAssertionExecuted();
    }

    public static function notHasKeyDataProvider(): array
    {
        return [
            [[], 0],
            [['alpha', 'beta', 'gamma'], 3],
            [['alpha' => ['beta', 'gamma']], 'beta'],
        ];
    }
}
