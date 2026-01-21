<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use PHPUnit\Framework\Assert;

trait StringAssertions
{
    // region Regex Methods

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
        Assert::assertMatchesRegularExpression($pattern, $this->variable, $message);

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
        Assert::assertDoesNotMatchRegularExpression($pattern, $this->variable, $message);

        return $this;
    }

    // endregion Regex Methods

    // region Contains Methods

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
        Assert::assertStringContainsString($string, $this->variable, $message);

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
        Assert::assertStringNotContainsString($string, $this->variable, $message);

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
        Assert::assertStringContainsStringIgnoringCase($string, $this->variable, $message);

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
            $string,
            $this->variable,
            $message
        );

        return $this;
    }

    // endregion Contains Methods

    // region Prefix/Suffix Methods

    /**
     * Asserts that a string starts with a given prefix.
     *
     * This method checks if the actual string starts with the specified prefix.
     *
     * @param string $prefix The prefix to check for.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     *
     * Example usage:
     * fact('hello world')->startsWith('hello'); // Passes
     * fact('world hello')->startsWith('hello'); // Fails
     */
    public function startsWith(string $prefix, string $message = ''): self
    {
        Assert::assertStringStartsWith($prefix, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a string ends with a given suffix.
     *
     * This method checks if the actual string ends with the specified suffix.
     *
     * @param string $suffix The suffix to check for.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     *
     * Example usage:
     * fact('file.txt')->endsWith('.txt'); // Passes
     * fact('txt.file')->endsWith('.txt'); // Fails
     */
    public function endsWith(string $suffix, string $message = ''): self
    {
        Assert::assertStringEndsWith($suffix, $this->variable, $message);

        return $this;
    }

    // endregion Prefix/Suffix Methods

    // region Length Methods

    /**
     * Asserts that a string has a specific length.
     *
     * This method checks if the length of the actual string equals the expected length.
     *
     * @param int $length The expected length.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     *
     * Example usage:
     * fact('abc')->hasLength(3); // Passes
     * fact('abcd')->hasLength(3); // Fails
     */
    public function hasLength(int $length, string $message = ''): self
    {
        Assert::assertEquals($length, strlen($this->variable), $message);

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

    // endregion Length Methods
}