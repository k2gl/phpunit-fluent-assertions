<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use PHPUnit\Framework\Assert;

trait ArrayAssertions
{
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
        Assert::assertCount($expectedCount, $this->variable, $message);

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
        Assert::assertNotCount($elementsCount, $this->variable, $message);

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
                var_export($this->variable, true),
                var_export($values, true),
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
        Assert::assertArrayHasKey($key, $this->variable, $message);

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
        Assert::assertArrayNotHasKey($key, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that an array contains a specific value.
     *
     * This method checks if the actual array contains the specified value.
     *
     * Example usage:
     * fact([1, 2, 3])->contains(2); // Passes
     * fact([1, 2])->contains(3); // Fails
     *
     * @param mixed $value The value to check for.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function contains(mixed $value, string $message = ''): self
    {
        Assert::assertContains($value, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that an array does not contain a specific value.
     *
     * This method checks if the actual array does not contain the specified value.
     *
     * Example usage:
     * fact([1, 2])->doesNotContain(3); // Passes
     * fact([1, 2, 3])->doesNotContain(3); // Fails
     *
     * @param mixed $value The value that should not be present.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function doesNotContain(mixed $value, string $message = ''): self
    {
        Assert::assertNotContains($value, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that an array has a specific size.
     *
     * This method checks if the number of elements in the actual array equals the expected size.
     *
     * Example usage:
     * fact([1, 2])->hasSize(2); // Passes
     * fact([1, 2, 3])->hasSize(2); // Fails
     *
     * @param int $size The expected size.
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function hasSize(int $size, string $message = ''): self
    {
        Assert::assertCount($size, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that an array is empty.
     *
     * This method checks if the actual value is an empty array.
     *
     * Example usage:
     * fact([])->isEmptyArray(); // Passes
     * fact([1, 2])->isEmptyArray(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Returns the FluentAssertions instance for method chaining.
     */
    public function isEmptyArray(string $message = ''): self
    {
        Assert::assertCount(0, $this->variable, $message);

        return $this;
    }
}