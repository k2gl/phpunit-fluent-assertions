<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\HasProperty;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'notHasProperty')]
final class NotHasPropertyTest extends FluentAssertionsTestCase
{
    #[DataProvider('missingPropertyDataProvider')]
    public function testNotHasProperty(object $variable, string $property): void
    {
        // act
        fact($variable)->notHasProperty($property);

        // assert
        $this->correctAssertionExecuted();
    }

    public function testFailOnPresentProperty(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact((object) ['name' => 'John'])->notHasProperty('name');
    }

    public function testFailOnNonObject(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('scalar')->notHasProperty('name');
    }

    public static function missingPropertyDataProvider(): array
    {
        return [
            'empty object'   => [(object) [], 'name'],
            'other property' => [(object) ['name' => 'John'], 'age'],
        ];
    }
}
