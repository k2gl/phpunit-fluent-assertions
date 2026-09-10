# Changelog

All notable changes to this package are documented here. The format is based on
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project
adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [12.12.0] - 2026-09-10

### Added

- `doesNotThrow()`, the counterpart of `throws()`: the subject is called and the assertion
  fails if anything is thrown. It replaces the `$call(); $this->addToAssertionCount(1);`
  idiom for "this input is accepted".
- `throws()` takes an optional `inspect` callback that receives the thrown exception, so a
  status code or a payload can be checked with ordinary `fact()` calls instead of a
  try/catch block.

## [12.11.0] - 2026-09-09

### Added

- Numeric assertions `isCloseTo()` / `notCloseTo()`, comparing within a tolerance that
  defaults to `PHP_FLOAT_EPSILON` — enough for accumulated float noise, while money and
  percentages pass a delta of their own.
- The non-strict comparisons `isGreaterThanOrEqual()` / `isLowerThanOrEqual()`, plus
  `isNotZero()`, `isFinite()` and `isNan()`.
- JSON subset matching with `containsJson()` / `notContainsJson()`: only the keys named in
  the expectation are compared, so volatile fields in a response no longer have to be
  spelled out. Lists are matched by membership — an expected element may sit anywhere in
  the document, since an index is not the identity of an element the way a key is the
  identity of a value.
- JSON path assertions `jsonPath()`, `hasJsonPath()` and `notHasJsonPath()`, addressing a
  single value by a dot-separated path (`data.0.id`).
- `matchesJsonFile()`, the fixture-file counterpart of `matchesJson()`.
- `matchesJson()` and `notMatchesJson()` now also accept the expectation as an array or
  object, which keeps `json_encode()` out of the test.
- The PHPStan extension narrows the subject of every JSON assertion to `string`, of
  `isCloseTo()` / `notCloseTo()` / `isFinite()` to `int|float`, and of `isNan()` to `float`.

### Changed

- `arrayContainsAssociativeArray()` now answers the subset question the same way
  `containsJson()` does. Inside a list an expected element may sit at any position instead
  of having to line up by index, so assertions that used to fail on reordered data now
  pass. It also tells a missing key apart from a key holding `null`: expecting
  `['parent' => null]` against `['id' => 1]` used to pass and now fails, which turns tests
  that were asserting nothing red.
- The JSON assertions moved from `StringAssertions` into a `JsonAssertions` trait. The
  public API is unchanged; only code using the trait directly is affected.

### Fixed

- `isJson()` no longer calls `json_validate()`, which only exists on PHP 8.3+ while the
  package supports 8.1. It now validates the same way the other JSON assertions do.

## [12.10.0] - 2026-07-07

### Added

- `notHasProperty()` — the negative counterpart of `hasProperty()`, asserting
  that an object lacks a property (replaces `assertObjectNotHasProperty`).

## [12.9.0] - 2026-07-01

### Added

- JSON assertions `matchesJson()` / `notMatchesJson()` — compare a JSON-string
  subject to an expected document by value, ignoring object key order and
  formatting (array element order stays significant). Both sides must be valid JSON.
- The PHPStan extension now narrows the subject of `isJson()`, `matchesJson()` and
  `notMatchesJson()` to `string`.

## [12.8.0] - 2026-06-13

### Added

- Exception assertion `throws()` — invokes a callable subject and asserts the
  expected exception is thrown, optionally matching a message substring.
- Date/time assertions `isBefore()`, `isAfter()`, `isSameDate()` for a
  `DateTimeInterface` subject (string expectations are parsed).
- Enum assertions `isEnum()`, `hasValue()`, `hasName()` for native
  `UnitEnum` / `BackedEnum` subjects.

## [12.7.0] - 2026-06-05

### Changed

- Adopted Laravel Pint for code style, raised PHPStan analysis to level 9, and
  added shields.io badges and a combined check script.

## [12.6.0] - 2026-05-27

### Added

- Extended the PHPStan type-specifying extension to narrow every type check
  (`isString`, `isInt`, `isFloat`, `isBool`, `isArray`, `isCallable`,
  `isResource`).

### Changed

- Fixed latent static-analysis errors and ran the CI matrix across PHP 8.2–8.5
  (with a PHP 8.1 source/static-analysis job).

[12.11.0]: https://github.com/k2gl/phpunit-fluent-assertions/compare/12.10.0...12.11.0
[12.10.0]: https://github.com/k2gl/phpunit-fluent-assertions/compare/12.9.0...12.10.0
[12.9.0]: https://github.com/k2gl/phpunit-fluent-assertions/compare/12.8.0...12.9.0
[12.8.0]: https://github.com/k2gl/phpunit-fluent-assertions/compare/12.7.0...12.8.0
[12.7.0]: https://github.com/k2gl/phpunit-fluent-assertions/compare/12.6.0...12.7.0
[12.6.0]: https://github.com/k2gl/phpunit-fluent-assertions/compare/12.5.0...12.6.0
