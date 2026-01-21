# Fluent assertions for PHPUnit

This library is insperated by [Vladimir Khorikov](https://enterprisecraftsmanship.com/), the author
of [Unit Testing: Principles, Patterns and Practices](https://enterprisecraftsmanship.com/book-amazon) and makes checks in tests more readable.

[![GitHub Actions](https://github.com/k2gl/phpunit-fluent-assertions/workflows/CI/badge.svg)](https://github.com/k2gl/phpunit-fluent-assertions/actions?workflow=CI)

## Installation

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

```
composer require --dev k2gl/phpunit-fluent-assertions
```

## Usage
Write tests as usual, just use fluent assertions short aliases ``` check($x)->...; ```, ``` expect($x)->...; ``` or ``` fact($x)->...; ```  instead of ```self::assert...($x, $y)```.

```php
// arrange
$user = UserFactory::createOne([
    'phone' => $phoneBefore = faker()->e164PhoneNumber;
]);

// act
$user->setPhone(
    $phoneAfter = faker()->e164PhoneNumber
);

// assert

// traditional PHPUnit assertions
self::assertSame(expected: $phoneAfter, actual: $user->getPhone());
self::assertNotSame(expected: $phoneBefore, actual: $user->getPhone());

### Comparison and Equality Methods
```php
fact(42)->is(42)->equals(42)->not(43);
```

### Boolean Methods
```php
fact(true)->true()->notFalse();
```

### Null Methods
```php
fact(null)->null()->notNull();
```

### Numeric Methods
```php
fact(5)->isLowerThan(10)->isGreaterThan(0)->isPositive()->isNegative()->isZero()->isBetween(1, 10);
```

### String Methods
```php
fact('hello world')->matchesRegularExpression('/\w+/')->startsWith('hello')->endsWith('world')->hasLength(11)->isEmptyString();
```

### Array Methods
```php
fact([1, 2, 3])->count(3)->contains(2)->doesNotContain(4)->hasSize(3)->isEmptyArray();
```

### Type Checking Methods
```php
fact(42)->isInt()->isString()->instanceOf(int::class)->hasProperty('name')->hasMethod('doSomething');
```

### Special Methods
```php
fact('01ARZ3NDEKTSV4RRFFQ69G5FAV')->ulid();
```
    ...
    ;

fact(
    [
        'a' => ['any' => 'thing'],
        'b' => ['any' => 'thing', 'type' => 'candy', 'color' => 'green'],
        'c' => ['miss' => 'kiss', 'foo' => 'bar', 'any' => 'thing'],
        'd' => ['any' => 'thing'],
    ]
)->arrayContainsAssociativeArray(
    [
        'c' => ['foo' => 'bar', 'miss' => 'kiss'],
        'b' => ['color' => 'green'],
    ]
); // true

```

## Pull requests are always welcome
[Collaborate with pull requests](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)

