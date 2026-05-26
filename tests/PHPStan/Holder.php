<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\PHPStan;

/**
 * Helper for the property-narrowing assertion in data/narrowing.php. Lives in an
 * autoloadable location so PHPStan's reflection can resolve $holder->context.
 */
final class Holder
{
    /** @param array{something: string}|null $context */
    public function __construct(
        public readonly ?array $context = null,
    ) {
    }
}
