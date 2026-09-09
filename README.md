# Fluent assertions for PHPUnit

This library is inspired by [Vladimir Khorikov](https://enterprisecraftsmanship.com/), the author
of [Unit Testing: Principles, Patterns and Practices](https://enterprisecraftsmanship.com/book-amazon) and makes checks in tests more readable.

[![CI](https://img.shields.io/github/actions/workflow/status/k2gl/phpunit-fluent-assertions/ci.yml?branch=main&label=CI&logo=github)](https://github.com/k2gl/phpunit-fluent-assertions/actions/workflows/ci.yml)
[![Latest Stable Version](https://img.shields.io/packagist/v/k2gl/phpunit-fluent-assertions?logo=packagist&logoColor=white)](https://packagist.org/packages/k2gl/phpunit-fluent-assertions)
[![Total Downloads](https://img.shields.io/packagist/dt/k2gl/phpunit-fluent-assertions?logo=packagist&logoColor=white)](https://packagist.org/packages/k2gl/phpunit-fluent-assertions)
[![PHPStan Level](https://img.shields.io/badge/PHPStan-level%209-2a5ea7?logo=php&logoColor=white)](https://phpstan.org)
[![License](https://img.shields.io/packagist/l/k2gl/phpunit-fluent-assertions?color=yellowgreen)](https://packagist.org/packages/k2gl/phpunit-fluent-assertions)

## Installation

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

```
composer require --dev k2gl/phpunit-fluent-assertions
```

## Usage
Write tests as usual, just use fluent assertions short aliases ``` check($x)->...; ```, ``` expect($x)->...; ``` or ``` fact($x)->...; ```  instead of ```self::assert...($x, $y)```.

```php
// arrange
$user = UserFactory::createOne();

// act
$user->setPhone($e164PhoneNumber = faker()->e164PhoneNumber);

// traditional PHPUnit assertions
self::assertSame($e164PhoneNumber, $user->getPhone());

// fluent assertions
fact($user->getPhone())
    ->is($e164PhoneNumber)
    ->isString()
    ->startsWith('+7')
    // etc.
    ;
```

### Array assertions
```php
fact([1, 2, 3])->count(3); // Passes
fact([1, 2])->count(3); // Fails

fact([1, 2])->notCount(3); // Passes
fact([1, 2, 3])->notCount(3); // Fails
     
fact(['a' => ['b' => 'c']])->arrayContainsAssociativeArray(['a' => ['b' => 'c']]); // Passes
fact(['a' => ['b' => 'd']])->arrayContainsAssociativeArray(['a' => ['b' => 'c']]); // Fails

fact(['a' => 1])->arrayHasKey('a'); // Passes
fact(['a' => 1])->arrayHasKey('b'); // Fails
     
fact(['a' => 1])->arrayNotHasKey('b'); // Passes
fact(['a' => 1])->arrayNotHasKey('a'); // Fails

fact([1, 2, 3])->contains(2); // Passes
fact([1, 2])->contains(3); // Fails

fact([1, 2])->doesNotContain(3); // Passes
fact([1, 2, 3])->doesNotContain(3); // Fails     
     
fact([1, 2])->hasSize(2); // Passes
fact([1, 2, 3])->hasSize(2); // Fails

fact([])->isEmptyArray(); // Passes
fact([1, 2])->isEmptyArray(); // Fails
     
fact([1, 2])->isNotEmptyArray(); // Passes
fact([])->isNotEmptyArray(); // Fails

fact([2, 4, 6])->every(fn($v) => $v % 2 === 0); // Passes
fact([1, 2, 3])->every(fn($v) => $v > 5); // Fails

fact([1, 2, 3])->some(fn($v) => $v > 2); // Passes
fact([1, 2, 3])->some(fn($v) => $v > 10); // Fails

fact([1, 2, 3])->none(fn($v) => $v > 10); // Passes
fact([1, 2, 3])->none(fn($v) => $v > 2); // Fails
```

### Boolean assertions
```php
fact(true)->true(); // Passes
fact(1)->true(); // Fails due to strict comparison

fact(false)->notTrue(); // Passes
fact(true)->notTrue(); // Fails

fact(false)->false(); // Passes
fact(0)->false(); // Fails due to strict comparison

fact(true)->notFalse(); // Passes
fact(false)->notFalse(); // Fails
```

### Comparison and equality assertions
```php
fact(42)->is(42); // Passes
fact(42)->is('42'); // Fails due to type difference

fact(42)->equals(42); // Passes
fact(42)->equals('42'); // Passes due to loose comparison

fact(42)->not(43); // Passes
fact(42)->not(42); // Fails
```

### Null assertions
```php
fact(null)->null(); // Passes
fact('')->null(); // Fails

fact(42)->notNull(); // Passes
fact(null)->notNull(); // Fails
```

### Numeric assertions
```php
fact(5)->isLowerThan(10); // Passes
fact(10)->isLowerThan(5); // Fails

fact(10)->isGreaterThan(5); // Passes
fact(5)->isGreaterThan(10); // Fails

fact(5)->isPositive(); // Passes
fact(-3)->isPositive(); // Fails

fact(-3)->isNegative(); // Passes
fact(5)->isNegative(); // Fails

fact(0)->isZero(); // Passes
fact(0.0)->isZero(); // Passes
fact(1)->isZero(); // Fails

fact(5)->isBetween(1, 10); // Passes
fact(15)->isBetween(1, 10); // Fails

fact(10)->isGreaterThanOrEqual(10); // Passes
fact(5)->isGreaterThanOrEqual(10); // Fails

fact(5)->isLowerThanOrEqual(5); // Passes
fact(10)->isLowerThanOrEqual(5); // Fails

fact(1)->isNotZero(); // Passes
fact(0.0)->isNotZero(); // Fails

fact(1.5)->isFinite(); // Passes
fact(INF)->isFinite(); // Fails

fact(sqrt(-1))->isNan(); // Passes
fact(1.0)->isNan(); // Fails
```

Comparing floats with a tolerance — the delta defaults to `PHP_FLOAT_EPSILON`, which
covers accumulated arithmetic noise. It is an absolute tolerance, so money, percentages
and values far from `1.0` want a delta of their own.
```php
fact(0.1 + 0.2)->isCloseTo(0.3); // Passes — strict comparison would not
fact(99.985)->isCloseTo(99.99, 0.005); // Passes
fact(99.9)->isCloseTo(99.99, 0.005); // Fails

fact(1.0)->notCloseTo(2.0); // Passes
fact(0.1 + 0.2)->notCloseTo(0.3); // Fails
```

### String assertions
```php
fact('abc123')->matchesRegularExpression('/^[a-z]+\d+$/'); // Passes
fact('123abc')->matchesRegularExpression('/^[a-z]+\d+$/'); // Fails

fact('123abc')->notMatchesRegularExpression('/^[a-z]+\d+$/'); // Passes
fact('abc123')->notMatchesRegularExpression('/^[a-z]+\d+$/'); // Fails

fact('hello world')->containsString('world'); // Passes
fact('hello world')->containsString('foo'); // Fails

fact('hello world')->notContainsString('foo'); // Passes
fact('hello world')->notContainsString('world'); // Fails

fact('Hello World')->containsStringIgnoringCase('world'); // Passes
fact('Hello World')->containsStringIgnoringCase('foo'); // Fails

fact('Hello World')->notContainsStringIgnoringCase('foo'); // Passes
fact('Hello World')->notContainsStringIgnoringCase('world'); // Fails

fact('hello world')->startsWith('hello'); // Passes
fact('world hello')->startsWith('hello'); // Fails

fact('file.txt')->endsWith('.txt'); // Passes
fact('txt.file')->endsWith('.txt'); // Fails

fact('abc')->hasLength(3); // Passes
fact('abcd')->hasLength(3); // Fails

fact('')->isEmptyString(); // Passes
fact('hello')->isEmptyString(); // Fails

fact('hello')->isNotEmptyString(); // Passes
fact('')->isNotEmptyString(); // Fails

fact('user@example.com')->isValidEmail(); // Passes
fact('invalid-email')->isValidEmail(); // Fails

fact('01ARZ3NDEKTSV4RRFFQ69G5FAV')->ulid(); // Passes (if valid ULID)
fact('invalid-ulid')->ulid(); // Fails
```

### JSON assertions
The subject is a JSON string. Documents are compared by value, so object key order and
formatting never matter; array element order does. An expectation can be written as JSON
text or as the array/object it would encode to, which keeps `json_encode()` out of the test.
```php
fact('{"key": "value"}')->isJson(); // Passes
fact('invalid json')->isJson(); // Fails

fact('{"a":1,"b":2}')->matchesJson('{"b":2,"a":1}'); // Passes (key order ignored)
fact('{"a":1,"b":2}')->matchesJson(['b' => 2, 'a' => 1]); // Passes
fact('{"a":1}')->matchesJson('{"a":2}'); // Fails

fact('{"a":1}')->notMatchesJson('{"a":2}'); // Passes
fact('{"a":1,"b":2}')->notMatchesJson('{"b":2,"a":1}'); // Fails

fact($canonicalJson)->matchesJsonFile(__DIR__ . '/fixtures/bundle.json'); // Passes when equal
```

`containsJson()` matches a subset. In an object, the keys you name must be present with a
matching value and everything else is ignored — which is what makes it usable against
responses carrying volatile fields. In a list, each expected element must match *some*
element of the document, at any position, and two expectations never claim the same one.
Scalars are compared strictly.
```php
fact('{"id":42,"created_at":"2026-01-01"}')->containsJson(['id' => 42]); // Passes
fact('{"data":{"id":42,"role":"admin"}}')->containsJson(['data' => ['id' => 42]]); // Passes
fact('{"items":[{"id":1},{"id":2}]}')->containsJson(['items' => [['id' => 2]]]); // Passes
fact('{"tags":["b","a"]}')->containsJson(['tags' => ['a']]); // Passes — position is not identity
fact('{"tags":["a"]}')->containsJson(['tags' => ['a', 'a']]); // Fails — only one to go around
fact('{"id":42}')->containsJson(['id' => '42']); // Fails — strict comparison

fact('{"id":42}')->notContainsJson(['id' => 43]); // Passes
fact('{"id":42}')->notContainsJson(['id' => 42]); // Fails
```

Element order and the exact shape of a list are `matchesJson()`'s job, not this one's.

Single values are reachable by a dot-separated path; segments address object keys and list
positions alike. Keys that contain a dot are not addressable this way.
```php
fact('{"data":[{"id":42}]}')->jsonPath('data.0.id', 42); // Passes
fact('{"meta":{"total":3}}')->jsonPath('meta.total', '3'); // Fails — strict comparison

fact('{"data":{"id":42}}')->hasJsonPath('data.id'); // Passes
fact('{"data":{"id":42}}')->notHasJsonPath('data.name'); // Passes
```

### Type Checking assertions
```php
fact(new stdClass())->instanceOf(stdClass::class); // Passes
fact(new stdClass())->instanceOf(Exception::class); // Fails

fact(new stdClass())->notInstanceOf(Exception::class); // Passes
fact(new stdClass())->notInstanceOf(stdClass::class); // Fails

fact(42)->isInt(); // Passes
fact('42')->isInt(); // Fails

fact('text')->isString(); // Passes
fact(42)->isString(); // Fails

fact((object)['name' => 'John'])->hasProperty('name'); // Passes
fact((object)['name' => 'John'])->hasProperty('age'); // Fails

fact((object)['name' => 'John'])->notHasProperty('age'); // Passes
fact((object)['name' => 'John'])->notHasProperty('name'); // Fails

fact(new stdClass())->hasMethod('__construct'); // Passes
fact(new stdClass())->hasMethod('nonExistentMethod'); // Fails

fact(3.14)->isFloat(); // Passes
fact(42)->isFloat(); // Fails

fact(true)->isBool(); // Passes
fact(1)->isBool(); // Fails

fact([1, 2])->isArray(); // Passes
fact('not array')->isArray(); // Fails

fact(fopen('php://memory', 'r'))->isResource(); // Passes
fact('string')->isResource(); // Fails

fact('strlen')->isCallable(); // Passes
fact(123)->isCallable(); // Fails

fact(3.14)->isFloat(); // Passes
fact(42)->isFloat(); // Fails

fact(true)->isBool(); // Passes
fact(1)->isBool(); // Fails
```

### Exception assertions
The subject is a callable; `throws()` invokes it and asserts the expected exception is thrown.
Pass a message substring to also assert on the exception message.
```php
fact(fn () => throw new RuntimeException('boom'))->throws(RuntimeException::class); // Passes
fact(fn () => $service->run())->throws(DomainException::class, 'invalid'); // Passes if message contains "invalid"
fact(fn () => 42)->throws(RuntimeException::class); // Fails — nothing thrown
```

### Date/time assertions
The subject is a `DateTimeInterface`; a string expectation is parsed as a `DateTimeImmutable`.
```php
fact(new DateTimeImmutable('2024-01-01'))->isBefore('2024-12-31'); // Passes
fact(new DateTimeImmutable('2024-12-31'))->isAfter('2024-01-01'); // Passes
fact(new DateTimeImmutable('2024-06-13 23:59'))->isSameDate('2024-06-13'); // Passes — same calendar date, time ignored
```

### Enum assertions
Work on any native `UnitEnum` / `BackedEnum`.
```php
fact($order->status)->isEnum(Status::Paid);   // identity: the subject is that case
fact(Status::Paid)->hasValue('paid');          // BackedEnum backing value
fact(Status::Paid)->hasName('Paid');           // case name
```

## PHPStan support

The package ships a PHPStan extension that narrows the asserted value, so the analyser
keeps following your types after a fluent assertion:

```php
/** @var array{something: string}|null $context */
$context = $user->getContext();

echo $context['something']; // PHPStan error: Cannot access offset 'something' on array{something: string}|null

fact($context)->notNull();

echo $context['something']; // OK: $context is narrowed to array{something: string}
```

More examples — every supported assertion narrows the subject in place:

```php
// instanceOf(): a union is narrowed to the concrete class
/** @var DateTimeInterface|null $date */
fact($date)->instanceOf(DateTimeImmutable::class);
// → $date is DateTimeImmutable

// notInstanceOf(): the class is subtracted from the union
/** @var DateTime|DateTimeImmutable $createdAt */
fact($createdAt)->notInstanceOf(DateTimeImmutable::class);
// → $createdAt is DateTime

// true() / false(): a bool is narrowed to the literal
/** @var bool $flag */
fact($flag)->true();      // → $flag is true
/** @var bool $enabled */
check($enabled)->false(); // → $enabled is false

// is(): narrowed to the exact expected value (assertSame semantics)
/** @var mixed $status */
fact($status)->is('active');
// → $status is 'active'

// null(): narrowed to null
/** @var string|null $token */
fact($token)->null();
// → $token is null

// type checks: narrowed to the asserted PHP type
/** @var mixed $value */
fact($value)->isString();
// → $value is string  (likewise isInt/isFloat/isBool/isArray/isCallable/isResource)

// chains accumulate every supported step
/** @var string|null $name */
fact($name)->notNull()->is('admin');
// → $name is 'admin'
```

The chain can be opened with any of `check()`, `expect()`, `fact()` or
`FluentAssertions::for()`, and the subject may be a variable or a property
(e.g. `fact($user->getContext())->notNull()`).

If you use [`phpstan/extension-installer`](https://github.com/phpstan/extension-installer)
it is picked up automatically. Otherwise include it manually in your `phpstan.neon`:

```neon
includes:
    - vendor/k2gl/phpunit-fluent-assertions/extension.neon
```

Narrowing is applied for `notNull()`, `null()`, `true()`, `notTrue()`, `false()`,
`notFalse()`, `instanceOf()`, `notInstanceOf()`, `is()`, the type checks `isString()`,
`isInt()`, `isFloat()`, `isBool()`, `isArray()`, `isCallable()` and `isResource()`, every JSON
assertion (subject narrowed to `string`), and the numeric assertions that guard their subject —
`isCloseTo()`, `notCloseTo()` and `isFinite()` (to `int|float`) and `isNan()` (to `float`). Loose
or negated assertions such as `equals()` (loose `==`) and `not()` would not narrow soundly, so they
are intentionally left out and leave the type unchanged.

## Pull requests are always welcome
[Collaborate with pull requests](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)

