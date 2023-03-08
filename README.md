# Fluent assertions for PHPUnit

This library is insperated by [Vladimir Khorikov](https://enterprisecraftsmanship.com/), the author
of [Unit Testing: Principles, Patterns and Practices](https://enterprisecraftsmanship.com/book-amazon) and makes checks in tests more readable.

## Installation

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

```
composer require --dev k2gl/phpunit-fluent-assertions
```

## Usage
Write tests as usual, just use fluent assertions short aliases ``` check($x)->...; ```, ``` expect($x)->...; ```, ``` fact($x)->...; ```  instead of ```self::assert...($x, $y)```.

```php
// arrange
$phoneBeforeAct = faker()->e164PhoneNumber;
$phoneAfterAct = faker()->e164PhoneNumber;

$user = UserFactory::createOne([
    'phone' => $phoneBeforeAct
]);


// act
...

// traditional PHPUnit assertions
self::assertSame(expected: $phoneAfterAct, actual: $user->getPhone());
self::assertNotSame(expected: $phoneBeforeAct, actual: $user->getPhone());

// fluent assertions
fact($user->getPhone())
    ->is($phoneAfterAct)
    ->not($phoneBeforeAct)
    ...
    ;
```

## Pull requests are always welcome
[Collaborate with pull requests](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)

