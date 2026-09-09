<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;

/**
 * @phpstan-require-extends FluentAssertions
 */
trait JsonAssertions
{
    // region Validity

    /**
     * Asserts that a string is valid JSON.
     *
     * This method checks if the actual string is valid JSON.
     *
     * Example usage:
     * fact('{"key": "value"}')->isJson(); // Passes
     * fact('invalid json')->isJson(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function isJson(string $message = ''): self
    {
        if (! is_string($this->variable)) {
            Assert::fail($message ?: 'Variable is not a string.');
        }

        json_decode($this->variable);

        Assert::assertTrue(json_last_error() === JSON_ERROR_NONE, $message ?: 'String is not valid JSON.');

        return $this;
    }

    // endregion Validity

    // region Whole-document Matching

    /**
     * Asserts that a variable is a JSON string semantically equal to the expected document.
     *
     * Both documents are compared by value, so object key order and formatting are
     * ignored (`{"a":1,"b":2}` matches `{"b":2,"a":1}`); array element order stays
     * significant. The expectation may be given as JSON text or as the array/object it
     * would encode to, which keeps `json_encode()` calls out of the test.
     *
     * Example usage:
     * fact('{"a":1,"b":2}')->matchesJson('{"b":2,"a":1}'); // Passes
     * fact('{"a":1,"b":2}')->matchesJson(['b' => 2, 'a' => 1]); // Passes
     * fact('{"a":1}')->matchesJson('{"a":2}'); // Fails
     *
     * @param string|array<mixed>|object $expected The expected document, as JSON text or as a value to encode.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function matchesJson(string|array|object $expected, string $message = ''): self
    {
        $actual = $this->decodeJsonSubject($message);

        Assert::assertEquals(
            $this->decodeJsonExpectation($expected, $message),
            $actual,
            $message,
        );

        return $this;
    }

    /**
     * Asserts that a variable is a JSON string not equal to the given document.
     *
     * The inverse of matchesJson(): both sides must be valid JSON and must differ by
     * value (object key order and formatting are still ignored).
     *
     * Example usage:
     * fact('{"a":1}')->notMatchesJson('{"a":2}'); // Passes
     * fact('{"a":1,"b":2}')->notMatchesJson('{"b":2,"a":1}'); // Fails
     *
     * @param string|array<mixed>|object $expected The document the variable must not equal.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function notMatchesJson(string|array|object $expected, string $message = ''): self
    {
        $actual = $this->decodeJsonSubject($message);

        Assert::assertNotEquals(
            $this->decodeJsonExpectation($expected, $message),
            $actual,
            $message,
        );

        return $this;
    }

    /**
     * Asserts that a variable is a JSON string semantically equal to the document in a file.
     *
     * The file-based counterpart of matchesJson(), for tests that keep the expected
     * payload as a fixture instead of a literal.
     *
     * Example usage:
     * fact($canonicalJson)->matchesJsonFile(__DIR__ . '/fixtures/bundle.json'); // Passes when equal
     *
     * @param string $path Path to a readable file holding the expected JSON document.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function matchesJsonFile(string $path, string $message = ''): self
    {
        return $this->matchesJson($this->readJsonFile($path, $message), $message);
    }

    // endregion Whole-document Matching

    // region Subset Matching

    /**
     * Asserts that a JSON document contains the expected subset.
     *
     * In an object, every key named in the expectation must be present with a matching
     * value and unnamed keys are ignored — which is what makes this usable against
     * responses carrying volatile fields (`created_at`, `_links`, ...). In a list, each
     * expected element must match some element of the document, at any position and
     * regardless of how many others are there; two expected elements never match the
     * same one. Nesting is walked recursively and scalars are compared strictly.
     *
     * Example usage:
     * fact('{"id":42,"created_at":"..."}')->containsJson(['id' => 42]); // Passes
     * fact('{"items":[{"id":1},{"id":2}]}')->containsJson(['items' => [['id' => 2]]]); // Passes
     * fact('{"id":42}')->containsJson(['id' => 43]); // Fails
     *
     * @param string|array<mixed>|object $expected The expected subset, as JSON text or as a value to encode.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function containsJson(string|array|object $expected, string $message = ''): self
    {
        [$document, $subset] = $this->decodeJsonSubsetPair($expected, $message);

        Assert::assertTrue(
            $this->jsonContainsSubset($document, $subset),
            $message ?: sprintf(
                "JSON document does not contain the expected subset.\n\nDocument: %s\n\nExpected subset: %s",
                self::encodeJsonForMessage($document),
                self::encodeJsonForMessage($subset),
            ),
        );

        return $this;
    }

    /**
     * Asserts that a JSON document does not contain the given subset.
     *
     * The inverse of containsJson(), with the same matching rules.
     *
     * Example usage:
     * fact('{"id":42}')->notContainsJson(['id' => 43]); // Passes
     * fact('{"id":42}')->notContainsJson(['id' => 42]); // Fails
     *
     * @param string|array<mixed>|object $expected The subset the document must not contain.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function notContainsJson(string|array|object $expected, string $message = ''): self
    {
        [$document, $subset] = $this->decodeJsonSubsetPair($expected, $message);

        Assert::assertFalse(
            $this->jsonContainsSubset($document, $subset),
            $message ?: sprintf(
                "JSON document contains the subset it should not.\n\nDocument: %s\n\nUnexpected subset: %s",
                self::encodeJsonForMessage($document),
                self::encodeJsonForMessage($subset),
            ),
        );

        return $this;
    }

    // endregion Subset Matching

    // region Path Matching

    /**
     * Asserts that the value at a dot-separated path in a JSON document is the expected one.
     *
     * Path segments address object keys and list positions alike (`data.0.id`). The
     * value is compared strictly, so `1` does not match `"1"`. A path that does not
     * exist fails the assertion. Keys that themselves contain a dot are not addressable.
     *
     * Example usage:
     * fact('{"data":[{"id":42}]}')->jsonPath('data.0.id', 42); // Passes
     * fact('{"meta":{"total":3}}')->jsonPath('meta.total', 4); // Fails
     *
     * @param string $path Dot-separated path into the document.
     * @param mixed $expected The expected value at that path.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function jsonPath(string $path, mixed $expected, string $message = ''): self
    {
        [$found, $value] = $this->resolveJsonPath($this->decodeJsonSubject($message, associative: true), $path);

        if (! $found) {
            Assert::fail($message ?: sprintf('JSON document has no value at path "%s".', $path));
        }

        Assert::assertSame($expected, $value, $message);

        return $this;
    }

    /**
     * Asserts that a dot-separated path exists in a JSON document, whatever its value.
     *
     * Example usage:
     * fact('{"data":{"id":42}}')->hasJsonPath('data.id'); // Passes
     * fact('{"data":{"id":42}}')->hasJsonPath('data.name'); // Fails
     *
     * @param string $path Dot-separated path into the document.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function hasJsonPath(string $path, string $message = ''): self
    {
        [$found] = $this->resolveJsonPath($this->decodeJsonSubject($message, associative: true), $path);

        Assert::assertTrue($found, $message ?: sprintf('JSON document has no value at path "%s".', $path));

        return $this;
    }

    /**
     * Asserts that a dot-separated path is absent from a JSON document.
     *
     * A path whose value is null still counts as present; use jsonPath() to assert null.
     *
     * Example usage:
     * fact('{"data":{"id":42}}')->notHasJsonPath('data.name'); // Passes
     * fact('{"data":{"id":42}}')->notHasJsonPath('data.id'); // Fails
     *
     * @param string $path Dot-separated path into the document.
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function notHasJsonPath(string $path, string $message = ''): self
    {
        [$found] = $this->resolveJsonPath($this->decodeJsonSubject($message, associative: true), $path);

        Assert::assertFalse($found, $message ?: sprintf('JSON document has a value at path "%s".', $path));

        return $this;
    }

    // endregion Path Matching

    /**
     * Decodes the subject, failing the assertion unless it is a valid JSON string.
     */
    private function decodeJsonSubject(string $message, bool $associative = false): mixed
    {
        if (! is_string($this->variable)) {
            Assert::fail($message ?: 'Variable is not a string.');
        }

        $decoded = json_decode($this->variable, $associative);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Assert::fail($message ?: 'Variable is not valid JSON.');
        }

        return $decoded;
    }

    /**
     * Brings an expectation given as JSON text or as a plain value into decoded form,
     * so both sides of a comparison are shaped the same way.
     *
     * @param string|array<mixed>|object $expected
     */
    private function decodeJsonExpectation(string|array|object $expected, string $message, bool $associative = false): mixed
    {
        if (! is_string($expected)) {
            $encoded = json_encode($expected);

            if ($encoded === false) {
                Assert::fail($message ?: 'Expected value cannot be encoded as JSON.');
            }

            $expected = $encoded;
        }

        $decoded = json_decode($expected, $associative);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Assert::fail($message ?: 'Expected value is not valid JSON.');
        }

        return $decoded;
    }

    /**
     * Decodes both sides of a subset comparison as arrays.
     *
     * @param string|array<mixed>|object $expected
     *
     * @return array{array<mixed>, array<mixed>}
     */
    private function decodeJsonSubsetPair(string|array|object $expected, string $message): array
    {
        $document = $this->decodeJsonSubject($message, associative: true);
        $subset = $this->decodeJsonExpectation($expected, $message, associative: true);

        if (! is_array($document)) {
            Assert::fail($message ?: 'Variable is not a JSON object or array.');
        }

        if (! is_array($subset)) {
            Assert::fail($message ?: 'Expected subset is not a JSON object or array.');
        }

        return [$document, $subset];
    }

    /**
     * Matches an expected subset against a decoded document.
     *
     * An object keeps subset semantics (unnamed keys are ignored); a list is matched by
     * membership rather than by position, because an index is not the identity of an
     * element the way a key is the identity of a value.
     *
     * @param array<mixed> $document
     * @param array<mixed> $subset
     */
    private function jsonContainsSubset(array $document, array $subset): bool
    {
        if (array_is_list($document) && array_is_list($subset)) {
            return $this->jsonListContainsAll($document, $subset, 0, []);
        }

        foreach ($subset as $key => $value) {
            if (! array_key_exists($key, $document) || ! $this->jsonValueMatches($document[$key], $value)) {
                return false;
            }
        }

        return true;
    }

    private function jsonValueMatches(mixed $documentValue, mixed $expected): bool
    {
        if (is_array($documentValue) && is_array($expected)) {
            return $this->jsonContainsSubset($documentValue, $expected);
        }

        return $documentValue === $expected;
    }

    /**
     * Pairs every expected element with a distinct document element.
     *
     * Backtracks rather than taking the first match: with subsets on both sides a greedy
     * pass can consume the only element a later expectation could have matched.
     *
     * @param array<int, mixed> $document
     * @param array<int, mixed> $expected
     * @param array<int, true> $taken
     */
    private function jsonListContainsAll(array $document, array $expected, int $index, array $taken): bool
    {
        if (! isset($expected[$index])) {
            return true;
        }

        foreach ($document as $position => $candidate) {
            if (isset($taken[$position]) || ! $this->jsonValueMatches($candidate, $expected[$index])) {
                continue;
            }

            if ($this->jsonListContainsAll($document, $expected, $index + 1, $taken + [$position => true])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Walks a dot-separated path.
     *
     * @return array{bool, mixed} Whether the path exists, and the value found there.
     */
    private function resolveJsonPath(mixed $document, string $path): array
    {
        $current = $document;

        foreach (explode('.', $path) as $segment) {
            if (! is_array($current) || ! array_key_exists($segment, $current)) {
                return [false, null];
            }

            $current = $current[$segment];
        }

        return [true, $current];
    }

    private static function encodeJsonForMessage(mixed $value): string
    {
        $encoded = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return $encoded === false ? var_export($value, true) : $encoded;
    }

    private function readJsonFile(string $path, string $message): string
    {
        if (! is_file($path) || ! is_readable($path)) {
            Assert::fail($message ?: sprintf('JSON file "%s" does not exist or is not readable.', $path));
        }

        $contents = file_get_contents($path);

        if ($contents === false) {
            Assert::fail($message ?: sprintf('JSON file "%s" could not be read.', $path));
        }

        return $contents;
    }
}
