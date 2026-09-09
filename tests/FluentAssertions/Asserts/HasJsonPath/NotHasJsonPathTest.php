<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\HasJsonPath;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'notHasJsonPath')]
final class NotHasJsonPathTest extends FluentAssertionsTestCase
{
    #[DataProvider('missingPathDataProvider')]
    public function testNotHasJsonPath(string $variable, string $path): void
    {
        // act
        fact($variable)->notHasJsonPath($path);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('existingPathDataProvider')]
    public function testFailsWhenPathExists(string $variable, string $path): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->notHasJsonPath($path);
    }

    public static function missingPathDataProvider(): array
    {
        return [
            'missing key'      => ['{"data":{"id":42}}', 'data.name'],
            'path into scalar' => ['{"id":42}', 'id.0'],
        ];
    }

    public static function existingPathDataProvider(): array
    {
        return [
            'top level key' => ['{"id":42}', 'id'],
            'null value'    => ['{"deleted_at":null}', 'deleted_at'],
        ];
    }
}
