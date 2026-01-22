# AGENTS.md - Requirements for Adding New Methods

This file outlines the requirements and best practices for adding new assertion methods to the PHPUnit Fluent Assertions library, based on the patterns established in previous implementations (e.g., `isLowerThan`, `isGreaterThan`).

## General Requirements

- **Version Compliance**: Always use the most current version of AGENTS.md and do not rely on cached or outdated copies. Refresh and re-read AGENTS.md before every change to ensure compliance with the latest requirements.
- **Branching and Commits**: It is forbidden to commit directly to the `main` branch. All changes must be added via pull request from a feature branch. If the current branch is `main`, MUST checkout to a new branch before changing any files. Do not push changes automatically—only push after explicit user request.
- **Pull Requests**: When creating a pull request, update the PR description with a detailed summary of changes, including new methods added, files modified, and any breaking changes. Ensure the description follows the format: Summary, Changes, Testing, Validation.
- **Method Signature**: All new methods must be public, accept an optional `$message` parameter (string, default empty), and return `self` to enable fluent chaining.
- **Type Safety**: Specify strict types for parameters where applicable (e.g., `int|float` for numeric comparisons). Avoid `mixed` unless necessary.
- **PHPUnit Integration**: Use appropriate PHPUnit assertion methods (e.g., `Assert::assertLessThan`) without named parameters for compatibility.
- **Fluent Design**: Ensure the method integrates seamlessly with the fluent interface.

## Code Organization

- **Trait-Based Structure**: Methods are organized into separate traits in `src/Traits/` for better maintainability.
  - `ComparisonAndEqualityAssertions`: Basic equality checks.
  - `BooleanAssertions`: True/false assertions.
  - `NullAssertions`: Null checks.
  - `NumericAssertions`: Numeric comparisons (e.g., isPositive, isBetween).
  - `StringAssertions`: String operations (e.g., startsWith, hasLength).
  - `ArrayAssertions`: Array checks (e.g., contains, hasSize).
  - `TypeCheckingAssertions`: Type validation (e.g., isInt, instanceOf, hasProperty).
  - `SpecialAssertions`: Specialized checks (e.g., ULID).
- Traits are imported into `FluentAssertions` class using `use` statements.
- Place new methods in the appropriate trait based on functionality.

## Documentation

- **PHPDoc**: Provide comprehensive PHPDoc with:
  - Brief description of what the assertion does.
  - Detailed explanation of the method's behavior.
  - Example usage in the docblock (MUST always be placed before @param and @return sections—never violate this order).
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