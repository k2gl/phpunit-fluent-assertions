<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Assert;

/**
 * @phpstan-require-extends FluentAssertions
 */
trait TypeCheckingAssertions
{
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
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function instanceOf(mixed $expected, string $message = ''): self
    {
        Assert::assertInstanceOf($expected, $this->variable, $message);

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
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function notInstanceOf(mixed $expected, string $message = ''): self
    {
        Assert::assertNotInstanceOf($expected, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a variable is of type int.
     *
     * This method checks if the actual value is an integer.
     *
     * Example usage:
     * fact(42)->isInt(); // Passes
     * fact('42')->isInt(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function isInt(string $message = ''): self
    {
        Assert::assertIsInt($this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a variable is of type string.
     *
     * This method checks if the actual value is a string.
     *
     * Example usage:
     * fact('text')->isString(); // Passes
     * fact(42)->isString(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function isString(string $message = ''): self
    {
        Assert::assertIsString($this->variable, $message);

        return $this;
    }

    /**
     * Asserts that an object has a specific property.
     *
     * This method checks if the actual object has the specified property.
     *
     * Example usage:
     * fact((object)['name' => 'John'])->hasProperty('name'); // Passes
     * fact((object)['name' => 'John'])->hasProperty('age'); // Fails
     *
     * @param string $property The property name.
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function hasProperty(string $property, string $message = ''): self
    {
        Assert::assertObjectHasProperty($property, $this->variable, $message);

        return $this;
    }

    /**
     * Asserts that an object has a specific method.
     *
     * This method checks if the actual object has the specified method.
     *
     * Example usage:
     * fact(new stdClass())->hasMethod('__construct'); // Passes
     * fact(new stdClass())->hasMethod('nonExistentMethod'); // Fails
     *
     * @param string $method The method name.
     * @param string $message Optional custom error message.
     *
     * @return self  Enables fluent chaining of assertion methods.
     */
    public function hasMethod(string $method, string $message = ''): self
    {
        Assert::assertTrue(method_exists($this->variable, $method), $message ?: "Object does not have method '$method'.");

        return $this;
    }

    /**
     * Asserts that a variable is of type float.
     *
     * This method checks if the actual value is a floating-point number.
     *
     * Example usage:
     * fact(3.14)->isFloat(); // Passes
     * fact(42)->isFloat(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function isFloat(string $message = ''): self
    {
        Assert::assertIsFloat($this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a variable is of type bool.
     *
     * This method checks if the actual value is a boolean.
     *
     * Example usage:
     * fact(true)->isBool(); // Passes
     * fact(1)->isBool(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function isBool(string $message = ''): self
    {
        Assert::assertIsBool($this->variable, $message);

        return $this;
    }

    /**
     * Asserts that a variable is of type array.
     *
     * This method checks if the actual value is an array.
     *
     * Example usage:
     * fact([1, 2])->isArray(); // Passes
     * fact('not array')->isArray(); // Fails
     *
     * @param string $message Optional custom error message.
     *
     * @return self Enables fluent chaining of assertion methods.
     */
    public function isArray(string $message = ''): self
    {
        Assert::assertIsArray($this->variable, $message);

        return $this;
    }
}