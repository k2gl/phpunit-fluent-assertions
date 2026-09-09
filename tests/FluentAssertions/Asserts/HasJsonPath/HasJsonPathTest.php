<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\HasJsonPath;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'hasJsonPath')]
final class HasJsonPathTest extends FluentAssertionsTestCase
{
    #[DataProvider('existingPathDataProvider')]
    public function testHasJsonPath(string $variable, string $path): void
    {
        // act
        fact($variable)->hasJsonPath($path);

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('missingPathDataProvider')]
    public function testFailsWhenPathIsMissing(mixed $variable, string $path): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->hasJsonPath($path);
    }

    public static function existingPathDataProvider(): array
    {
        return [
            'top level key' => ['{"id":42}', 'id'],
            'nested key'    => ['{"data":{"id":42}}', 'data.id'],
            'list position' => ['{"data":[{"id":42}]}', 'data.0'],
            'null value'    => ['{"deleted_at":null}', 'deleted_at'],
        ];
    }

    public static function missingPathDataProvider(): array
    {
        return [
            'missing key'      => ['{"data":{"id":42}}', 'data.name'],
            'path into scalar' => ['{"id":42}', 'id.0'],
            'invalid json'     => ['not json', 'id'],
            'not a string'     => [42, 'id'],
        ];
    }
}
