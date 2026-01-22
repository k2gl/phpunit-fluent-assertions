<?php declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\IsValidEmail;

use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'isValidEmail')]
final class IsValidEmailTest extends FluentAssertionsTestCase
{
    #[DataProvider('isValidEmailDataProvider')]
    public function testIsValidEmail(mixed $variable): void
    {
        // act
        fact($variable)->isValidEmail();

        // assert
        $this->correctAssertionExecuted();
    }

    #[DataProvider('notIsValidEmailDataProvider')]
    public function testNotIsValidEmail(mixed $variable): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact($variable)->isValidEmail();
    }

    public static function isValidEmailDataProvider(): array
    {
        return [
            ['user@example.com'],
            ['test.email+tag@domain.co.uk'],
        ];
    }

    public static function notIsValidEmailDataProvider(): array
    {
        return [
            ['invalid-email'],
            ['@example.com'],
            ['user@'],
            [''],
        ];
    }
}