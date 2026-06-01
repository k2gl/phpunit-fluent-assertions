<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\PHPStan;

use PHPStan\Testing\TypeInferenceTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Runs PHPStan over tests/PHPStan/data/narrowing.php with the shipped extension
 * (extension.neon) loaded, and checks every assertType() embedded there. Fails if the
 * fluent-assertion narrowing ever regresses.
 */
#[CoversNothing]
final class FluentAssertionsTypeInferenceTest extends TypeInferenceTestCase
{
    /**
     * @return iterable<mixed>
     */
    public static function dataFileAsserts(): iterable
    {
        yield from self::gatherAssertTypes(__DIR__ . '/data/narrowing.php');
    }

    #[DataProvider('dataFileAsserts')]
    public function testFileAsserts(string $assertType, string $file, mixed ...$args): void
    {
        $this->assertFileAsserts($assertType, $file, ...$args);
    }

    /**
     * @return array<int, string>
     */
    public static function getAdditionalConfigFiles(): array
    {
        return [dirname(__DIR__, 2) . '/extension.neon'];
    }
}
