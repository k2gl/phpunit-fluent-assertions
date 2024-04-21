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

// fluent assertions
fact($user->getPhone())
    ->is($phoneAfter)
    ->equals($phoneAfter)
    ->not($phoneBefore)
    ->true()
    ->notTrue()
    ->false()
    ->notFalse()
    ->null()
    ->notNull()
    ->matchesRegularExpression('#^\d+$#')
    ->notMatchesRegularExpression('#^\D+$#')
    ->containsString('alpha')
    ->notContainsString('alpha')
    ->containsStringIgnoringCase('beta')
    ->notContainsStringIgnoringCase('beta')
    ->count(5)
    ->notCount(5)
    ->arrayHasKey('echo')
    ->arrayNotHasKey('echo')
    ->instanceOf(UserFactory::class)
    ->notInstanceOf(UserFactory::class)
    ->ulid()
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

