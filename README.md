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

fact('{"key": "value"}')->isJson(); // Passes
fact('invalid json')->isJson(); // Fails

fact('user@example.com')->isValidEmail(); // Passes
fact('invalid-email')->isValidEmail(); // Fails

fact('01ARZ3NDEKTSV4RRFFQ69G5FAV')->ulid(); // Passes (if valid ULID)
fact('invalid-ulid')->ulid(); // Fails
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

## Pull requests are always welcome
[Collaborate with pull requests](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)

