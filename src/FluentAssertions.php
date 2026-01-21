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

    /**
     * Creates a new FluentAssertions instance for the given variable.
     *
     * This static method is a factory for starting fluent assertions on a variable.
     *
     * Example usage:
     * FluentAssertions::for($value)->is(42);
     *
     * @param mixed $variable The variable to assert on.
     *
     * @return self Returns a new FluentAssertions instance.
     */
    public static function for(mixed $variable = null): self
    {
        return new FluentAssertions(variable: $variable);
    }

    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference the same object.
     *
     * This method performs a strict comparison (===) between the actual value and the expected value.
     *
     * Example usage:
     * fact(42)->is(42); // Passes
     * fact(42)->is('42'); // Fails due to type difference
     *
     * @param mixed $expected The expected value to compare against.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function is(mixed $expected, string $message = ''): self
    {
        Assert::assertSame(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that two variables are equal.
     *
     * This method performs a loose comparison (==) between the actual value and the expected value.
     *
     * Example usage:
     * fact(42)->equals(42); // Passes
     * fact(42)->equals('42'); // Passes due to loose comparison
     *
     * @param mixed $expected The expected value to compare against.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function equals(mixed $expected, string $message = ''): self
    {
        Assert::assertEquals(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a numeric value is lower than another numeric value.
     *
     * This method checks if the actual value is strictly less than the expected value.
     * Both values must be of type int or float.
     *
     * @param int|float $expected The value to compare against.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     *
     * Example usage:
     * fact(5)->isLowerThan(10); // Passes
     * fact(10)->isLowerThan(5); // Fails
     */
    public function isLowerThan(int|float $expected, string $message = ''): self
    {
        Assert::assertLessThan($expected, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a numeric value is greater than another numeric value.
     *
     * This method checks if the actual value is strictly greater than the expected value.
     * Both values must be of type int or float.
     *
     * @param int|float $expected The value to compare against.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     *
     * Example usage:
     * fact(10)->isGreaterThan(5); // Passes
     * fact(5)->isGreaterThan(10); // Fails
     */
    public function isGreaterThan(int|float $expected, string $message = ''): self
    {
        Assert::assertGreaterThan($expected, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that an array is empty.
     *
     * This method checks if the actual value is an empty array.
     *
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     *
     * Example usage:
     * fact([])->isEmptyArray(); // Passes
     * fact([1, 2])->isEmptyArray(); // Fails
     */
    public function isEmptyArray(string $message = ''): self
    {
        Assert::assertCount(0, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a string is empty.
     *
     * This method checks if the actual value is an empty string.
     *
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     *
     * Example usage:
     * fact('')->isEmptyString(); // Passes
     * fact('hello')->isEmptyString(); // Fails
     */
    public function isEmptyString(string $message = ''): self
    {
        Assert::assertEmpty($this->variable, $message);

        return $this;
    }

    /**
     * Asserts that two variables do not have the same type and value.
     * Used on objects, it asserts that two variables do not reference the same object.
     *
     * This method performs a strict comparison (!==) to ensure the actual value is not the same as the expected value.
     *
     * Example usage:
     * fact(42)->not(43); // Passes
     * fact(42)->not(42); // Fails
     *
     * @param mixed $expected The value that the actual value should not be.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function not(mixed $expected, string $message = ''): self
    {
        Assert::assertNotSame(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is true.
     * Uses strict comparison (variable === true).
     *
     * This method checks if the actual value is exactly the boolean true.
     *
     * Example usage:
     * fact(true)->true(); // Passes
     * fact(1)->true(); // Fails due to strict comparison
     *
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function true(string $message = ''): self
    {
        Assert::assertTrue(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not true.
     * Uses strict comparison (variable !== true).
     *
     * This method checks if the actual value is not exactly the boolean true.
     *
     * Example usage:
     * fact(false)->notTrue(); // Passes
     * fact(true)->notTrue(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function notTrue(string $message = ''): self
    {
        Assert::assertNotTrue(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is false.
     * Uses strict comparison (variable === false).
     *
     * This method checks if the actual value is exactly the boolean false.
     *
     * Example usage:
     * fact(false)->false(); // Passes
     * fact(0)->false(); // Fails due to strict comparison
     *
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function false(string $message = ''): self
    {
        Assert::assertFalse(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not false.
     * Uses strict comparison (variable !== false).
     *
     * This method checks if the actual value is not exactly the boolean false.
     *
     * Example usage:
     * fact(true)->notFalse(); // Passes
     * fact(false)->notFalse(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function notFalse(string $message = ''): self
    {
        Assert::assertNotFalse(condition: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is null.
     *
     * This method checks if the actual value is exactly null.
     *
     * Example usage:
     * fact(null)->null(); // Passes
     * fact('')->null(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function null(string $message = ''): self
    {
        Assert::assertNull(actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not null.
     *
     * This method checks if the actual value is not null.
     *
     * Example usage:
     * fact(42)->notNull(); // Passes
     * fact(null)->notNull(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function notNull(string $message = ''): self
    {
        Assert::assertNotNull(actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable matches a given regular expression.
     *
     * This method checks if the string representation of the actual value matches the provided regex pattern.
     *
     * Example usage:
     * fact('abc123')->matchesRegularExpression('/^[a-z]+\d+$/'); // Passes
     * fact('123abc')->matchesRegularExpression('/^[a-z]+\d+$/'); // Fails
     *
     * @param string $pattern The regular expression pattern to match against.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function matchesRegularExpression(string $pattern, string $message = ''): self
    {
        Assert::assertMatchesRegularExpression(pattern: $pattern, string: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable does not match a given regular expression.
     *
     * This method checks if the string representation of the actual value does not match the provided regex pattern.
     *
     * Example usage:
     * fact('123abc')->notMatchesRegularExpression('/^[a-z]+\d+$/'); // Passes
     * fact('abc123')->notMatchesRegularExpression('/^[a-z]+\d+$/'); // Fails
     *
     * @param string $pattern The regular expression pattern that should not match.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function notMatchesRegularExpression(string $pattern, string $message = ''): self
    {
        Assert::assertDoesNotMatchRegularExpression(pattern: $pattern, string: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable contains a string.
     *
     * This method checks if the string representation of the actual value contains the specified substring.
     *
     * Example usage:
     * fact('hello world')->containsString('world'); // Passes
     * fact('hello world')->containsString('foo'); // Fails
     *
     * @param string $string The substring to search for.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function containsString(string $string, string $message = ''): self
    {
        Assert::assertStringContainsString(needle: $string, haystack: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable does not contain a string.
     *
     * This method checks if the string representation of the actual value does not contain the specified substring.
     *
     * Example usage:
     * fact('hello world')->notContainsString('foo'); // Passes
     * fact('hello world')->notContainsString('world'); // Fails
     *
     * @param string $string The substring that should not be present.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function notContainsString(string $string, string $message = ''): self
    {
        Assert::assertStringNotContainsString(needle: $string, haystack: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable contains a string, ignoring case.
     *
     * This method checks if the string representation of the actual value contains the specified substring, case-insensitively.
     *
     * Example usage:
     * fact('Hello World')->containsStringIgnoringCase('world'); // Passes
     * fact('Hello World')->containsStringIgnoringCase('foo'); // Fails
     *
     * @param string $string The substring to search for (case-insensitive).
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function containsStringIgnoringCase(string $string, string $message = ''): self
    {
        Assert::assertStringContainsStringIgnoringCase(needle: $string, haystack: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable does not contain a string, ignoring case.
     *
     * This method checks if the string representation of the actual value does not contain the specified substring, case-insensitively.
     *
     * Example usage:
     * fact('Hello World')->notContainsStringIgnoringCase('foo'); // Passes
     * fact('Hello World')->notContainsStringIgnoringCase('world'); // Fails
     *
     * @param string $string The substring that should not be present (case-insensitive).
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
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
     *
     * This method checks if the actual value has the expected number of elements.
     *
     * Example usage:
     * fact([1, 2, 3])->count(3); // Passes
     * fact([1, 2])->count(3); // Fails
     *
     * @param int $expectedCount The expected number of elements.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function count(int $expectedCount, string $message = ''): self
    {
        Assert::assertCount(expectedCount: $expectedCount, haystack: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that the number of elements is not equal to the expected count.
     *
     * This method checks if the actual value does not have the specified number of elements.
     *
     * Example usage:
     * fact([1, 2])->notCount(3); // Passes
     * fact([1, 2, 3])->notCount(3); // Fails
     *
     * @param int $elementsCount The number of elements that should not match.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function notCount(int $elementsCount, string $message = ''): self
    {
        Assert::assertNotCount(expectedCount: $elementsCount, haystack: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that the array contains another associative array.
     *
     * This method checks if the actual array contains all the key-value pairs from the provided array.
     *
     * Example usage:
     * fact(['a' => ['b' => 'c']])->arrayContainsAssociativeArray(['a' => ['b' => 'c']]); // Passes
     * fact(['a' => ['b' => 'd']])->arrayContainsAssociativeArray(['a' => ['b' => 'c']]); // Fails
     *
     * @param array $values The associative array that should be contained within the actual array.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
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
     * Asserts that the variable has a specific key.
     *
     * This method checks if the actual array has the specified key.
     *
     * Example usage:
     * fact(['a' => 1])->arrayHasKey('a'); // Passes
     * fact(['a' => 1])->arrayHasKey('b'); // Fails
     *
     * @param int|string $key The key to check for existence.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function arrayHasKey(int|string $key, string $message = ''): self
    {
        Assert::assertArrayHasKey(key: $key, array: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that the variable does not have a specific key.
     *
     * This method checks if the actual array does not have the specified key.
     *
     * Example usage:
     * fact(['a' => 1])->arrayNotHasKey('b'); // Passes
     * fact(['a' => 1])->arrayNotHasKey('a'); // Fails
     *
     * @param int|string $key The key that should not exist.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function arrayNotHasKey(int|string $key, string $message = ''): self
    {
        Assert::assertArrayNotHasKey(key: $key, array: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is an instance of a given type.
     *
     * This method checks if the actual value is an instance of the specified class or implements the interface.
     *
     * Example usage:
     * fact(new stdClass())->instanceOf(stdClass::class); // Passes
     * fact(new stdClass())->instanceOf(Exception::class); // Fails
     *
     * @param mixed $expected The class or interface name.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function instanceOf(mixed $expected, string $message = ''): self
    {
        Assert::assertInstanceOf(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is not an instance of a given type.
     *
     * This method checks if the actual value is not an instance of the specified class and does not implement the interface.
     *
     * Example usage:
     * fact(new stdClass())->notInstanceOf(Exception::class); // Passes
     * fact(new stdClass())->notInstanceOf(stdClass::class); // Fails
     *
     * @param mixed $expected The class or interface name that should not match.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function notInstanceOf(mixed $expected, string $message = ''): self
    {
        Assert::assertNotInstanceOf(expected: $expected, actual: $this->variable, message: $message);

        return $this;
    }

    /**
     * Asserts that a variable is a valid ULID.
     *
     * This method checks if the actual value matches the ULID (Universally Unique Lexicographically Sortable Identifier) format.
     *
     * @see https://github.com/ulid/spec
     *
     * Example usage:
     * fact('01ARZ3NDEKTSV4RRFFQ69G5FAV')->ulid(); // Passes (if valid ULID)
     * fact('invalid-ulid')->ulid(); // Fails
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function ulid(): self
    {
        return $this->matchesRegularExpression(pattern: RegularExpressionPattern::ULID);
    }
}
