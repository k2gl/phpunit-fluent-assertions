# AGENTS.md - Requirements for Adding New Methods

This file outlines the requirements and best practices for adding new assertion methods to the PHPUnit Fluent Assertions library, based on the patterns established in previous implementations (e.g., `isLowerThan`, `isGreaterThan`).

## General Requirements

- **Branching and Commits**: It is forbidden to commit directly to the `main` branch. All changes must be added via pull request from a feature branch.
- **Method Signature**: All new methods must be public, accept an optional `$message` parameter (string, default empty), and return `self` to enable fluent chaining.
- **Type Safety**: Specify strict types for parameters where applicable (e.g., `int|float` for numeric comparisons). Avoid `mixed` unless necessary.
- **PHPUnit Integration**: Use appropriate PHPUnit assertion methods (e.g., `Assert::assertLessThan`) without named parameters for compatibility.
- **Fluent Design**: Ensure the method integrates seamlessly with the fluent interface.

## Documentation

- **PHPDoc**: Provide comprehensive PHPDoc with:
  - Brief description of what the assertion does.
  - Detailed explanation of the method's behavior.
  - Example usage in the docblock (placed before @param and @return).
  - `@param` tags for each parameter (including $message).
  - `@return self` tag for fluent chaining.
- **README.md**: Update the usage section with an example of the new method in the fluent chain.

## Testing

- **Test File Structure**: Create a new test class in `tests/FluentAssertions/Asserts/MethodName/MethodNameTest.php`.
- **Attributes**: Use `#[CoversMethod(className: FluentAssertions::class, methodName: 'methodName')]`.
- **Test Methods**:
  - `testMethodName`: Uses data provider for positive cases, calls `fact($variable)->methodName($compare)`, and asserts `correctAssertionExecuted()`.
  - `testNotMethodName`: Uses data provider for negative cases, expects `incorrectAssertionExpected()`, calls the method, and expects failure.
- **Data Providers**: Provide arrays of test cases covering various scenarios (e.g., ints, floats for numeric methods).
- **Helper Usage**: Use `fact()` function for creating FluentAssertions instances in tests.

## Validation Steps

- **Run Tests**: Execute `./vendor/bin/phpunit tests/FluentAssertions/Asserts/MethodName/MethodNameTest.php` to verify implementation.
- **Lint and Typecheck**: Run linting and type checking commands (e.g., via composer scripts or direct tools) to ensure code quality.
- **Integration**: Ensure the method works in the overall fluent chain without breaking existing functionality.

## Example Workflow for Adding `isGreaterThan`

1. Add method to `FluentAssertions.php`:
   ```php
   /**
    * Asserts that a numeric value is greater than another numeric value.
    *
    * This method checks if the actual value is strictly greater than the expected value.
    * Both values must be of type int or float.
    *
    * Example usage:
    * fact(10)->isGreaterThan(5); // Passes
    * fact(5)->isGreaterThan(10); // Fails
    *
    * @param int|float $expected The value to compare against.
    * @param string $message Optional custom error message.
    *
    * @return self Returns the FluentAssertions instance for method chaining.
    */
   public function isGreaterThan(int|float $expected, string $message = ''): self
   {
       Assert::assertGreaterThan($expected, $this->variable, $message);

       return $this;
   }
   ```

2. Create tests in `tests/FluentAssertions/Asserts/IsGreaterThan/IsGreaterThanTest.php`.

3. Update README.md with example usage.

4. Run tests and validation.