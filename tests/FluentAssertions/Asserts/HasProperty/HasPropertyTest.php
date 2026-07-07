<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\HasProperty;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'hasProperty')]
final class HasPropertyTest extends FluentAssertionsTestCase
{
    public function testHasProperty(): void
    {
        // act
        fact((object) ['name' => 'John'])->hasProperty('name');

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('missingPropertyDataProvider')]
    public function testFailOnMissingProperty(object $variable, string $property): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->hasProperty($property);
    }

    public function testFailOnNonObject(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('scalar')->hasProperty('name');
    }

    public static function missingPropertyDataProvider(): array
    {
        return [
            'empty object'  => [(object) [], 'name'],
            'other property' => [(object) ['name' => 'John'], 'age'],
        ];
    }
}
