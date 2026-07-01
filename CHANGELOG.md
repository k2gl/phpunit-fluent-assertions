# Changelog

All notable changes to this package are documented here. The format is based on
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project
adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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

[12.9.0]: https://github.com/k2gl/phpunit-fluent-assertions/compare/12.8.0...12.9.0
[12.8.0]: https://github.com/k2gl/phpunit-fluent-assertions/compare/12.7.0...12.8.0
[12.7.0]: https://github.com/k2gl/phpunit-fluent-assertions/compare/12.6.0...12.7.0
[12.6.0]: https://github.com/k2gl/phpunit-fluent-assertions/compare/12.5.0...12.6.0
