<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions;

use K2gl\PHPUnitFluentAssertions\Reference\RegularExpressionPattern;
use PHPUnit\Framework\Assert;

class FluentAssertions
{
    public function __construct(
        public readonly mixed $variable = null
    ) {
    }

    public static function for(mixed $variable = null): self
    {
        return new FluentAssertions(variable: $variable);
    }

    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference
     * the same object.
     */
    public function is(mixed $expected, string $message = ''): self
    {
        Assert::assertSame(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that two variables are equal.
     */
    public function equals(mixed $expected, string $message = ''): self
    {
        Assert::assertEquals(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that two variables do not have the same type and value.
     * Used on objects, it asserts that two variables do not reference
     * the same object.
     */
    public function not(mixed $expected, string $message = ''): self
    {
        Assert::assertNotSame(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is true.
     * Use strict comparison (variable === true).
     */
    public function true(string $message = ''): self
    {
        Assert::assertTrue(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not true.
     * Use strict comparison (variable !== true).
     */
    public function notTrue(string $message = ''): self
    {
        Assert::assertNotTrue(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is false.
     * Use strict comparison (variable === false).
     */
    public function false(string $message = ''): self
    {
        Assert::assertFalse(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not true.
     * Use strict comparison (variable !== false).
     */
    public function notFalse(string $message = ''): self
    {
        Assert::assertNotFalse(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is null.
     */
    public function null(string $message = ''): self
    {
        Assert::assertNull(actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not null.
     */
    public function notNull(string $message = ''): self
    {
        Assert::assertNotNull(actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable matches a given regular expression.
     */
    public function matchesRegularExpression(string $pattern, string $message = ''): self
    {
        Assert::assertMatchesRegularExpression(pattern: $pattern, string: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable does not match a given regular expression.
     */
    public function notMatchesRegularExpression(string $pattern, string $message = ''): self
    {
        Assert::assertDoesNotMatchRegularExpression(pattern: $pattern, string: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable contains string.
     */
    public function containsString(string $string, string $message = ''): self
    {
        Assert::assertStringContainsString(needle: $string, haystack: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable does not contain string.
     */
    public function notContainsString(string $string, string $message = ''): self
    {
        Assert::assertStringNotContainsString(needle: $string, haystack: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable contains string in any case.
     */
    public function containsStringIgnoringCase(string $string, string $message = ''): self
    {
        Assert::assertStringContainsStringIgnoringCase(needle: $string, haystack: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable does not contain string in any case.
     */
    public function notContainsStringIgnoringCase(string $string, string $message = ''): self
    {
        Assert::assertStringNotContainsStringIgnoringCase(
            needle: $string,
            haystack: $this->variable,
            message: $message
        );

        return $this;
    }

    /**
     * Asserts the number of elements of an array, Countable or Traversable.
     */
    public function count(int $expectedCount, string $message = ''): self
    {
        Assert::assertCount(expectedCount: $expectedCount, haystack: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts the number of elements of an array, Countable or Traversable.
     */
    public function notCount(int $elementsCount, string $message = ''): self
    {
        Assert::assertNotCount(expectedCount: $elementsCount, haystack: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts contains another array.
     */
    public function arrayContainsAssociativeArray(array $values): self
    {
        Assert::assertTrue(
            condition: $this->arrayContainsAssociativeArrayRecursive($this->variable, $values),
            message: sprintf(
                "Array does not contain associative array. \n\nArray: '%s' \n\nExpected values: '%s'",
                var_export(value: $this->variable, return: true),
                var_export(value: $values, return: true),
            )
        );

        return $this;
    }

    protected function arrayContainsAssociativeArrayRecursive(array $data, array $values): bool
    {
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                if (!$this->arrayContainsAssociativeArrayRecursive($data[$key], $value)) {
                    return false;
                }
            } elseif ($data[$key] !== $value) {
                return false;
            }
        }

        return true;
    }

    /**
     * Asserts the variable has key.
     */
    public function arrayHasKey(int|string $key, string $message = ''): self
    {
        Assert::assertArrayHasKey(key: $key, array: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts the variable does not have key.
     */
    public function arrayNotHasKey(int|string $key, string $message = ''): self
    {
        Assert::assertArrayNotHasKey(key: $key, array: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is of a given type.
     */
    public function instanceOf(mixed $expected, string $message = ''): self
    {
        Assert::assertInstanceOf(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not of a given type.
     */
    public function notInstanceOf(mixed $expected, string $message = ''): self
    {
        Assert::assertNotInstanceOf(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is valid ulid.
     * @see https://github.com/ulid/spec
     */
    public function ulid(): self
    {
        return $this->matchesRegularExpression(pattern: RegularExpressionPattern::ULID);
    }
}
