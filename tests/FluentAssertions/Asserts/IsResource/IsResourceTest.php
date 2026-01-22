<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsResource;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isResource')]
final class IsResourceTest extends FluentAssertionsTestCase
{
    public function testIsResource(): void
    {
        $resource = fopen('php://memory', 'r');

        // act
        fact($resource)->isResource();

        // assert
        $this->correctAssertionExecuted();

        fclose($resource);
    }

    #[DataProvider('notIsResourceDataProvider')]
    public function testNotIsResource(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isResource();
    }

    public static function notIsResourceDataProvider(): array
    {
        return [
            ['string'],
            [42],
            [true],
            [null],
            [[]],
        ];
    }
}