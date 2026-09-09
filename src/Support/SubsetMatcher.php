<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Support;

/**
 * Decides whether a document contains an expected subset.
 *
 * Shared by the array and JSON subset assertions so both answer the question the same way.
 *
 * A map keeps subset semantics: the keys named in the expectation must be present with a
 * matching value, and unnamed keys are ignored. A list is matched by membership instead —
 * an index is not the identity of an element the way a key is the identity of a value, so
 * an expected element may sit at any position, and two expectations never claim the same
 * element.
 *
 * @internal
 */
final class SubsetMatcher
{
    /**
     * @param array<array-key, mixed> $document
     * @param array<array-key, mixed> $subset
     */
    public static function matches(array $document, array $subset): bool
    {
        if (array_is_list($document) && array_is_list($subset)) {
            return self::listMatches($document, $subset, 0, []);
        }

        foreach ($subset as $key => $value) {
            if (! array_key_exists($key, $document) || ! self::valueMatches($document[$key], $value)) {
                return false;
            }
        }

        return true;
    }

    private static function valueMatches(mixed $documentValue, mixed $expected): bool
    {
        if (is_array($documentValue) && is_array($expected)) {
            return self::matches($documentValue, $expected);
        }

        return $documentValue === $expected;
    }

    /**
     * Pairs every expected element with a distinct document element.
     *
     * Backtracks rather than keeping the first match: with subsets on both sides a greedy
     * pass can consume the only element a later expectation could have matched.
     *
     * @param list<mixed> $document
     * @param list<mixed> $expected
     * @param array<int, true> $taken
     */
    private static function listMatches(array $document, array $expected, int $index, array $taken): bool
    {
        if ($index === count($expected)) {
            return true;
        }

        foreach ($document as $position => $candidate) {
            if (isset($taken[$position]) || ! self::valueMatches($candidate, $expected[$index])) {
                continue;
            }

            if (self::listMatches($document, $expected, $index + 1, $taken + [$position => true])) {
                return true;
            }
        }

        return false;
    }
}
