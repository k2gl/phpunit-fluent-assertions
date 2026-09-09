<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\Asserts\MatchesJsonFile;

use K2gl\PHPUnitFluentAssertions\FluentAssertions;
use K2gl\PHPUnitFluentAssertions\Tests\FluentAssertions\FluentAssertionsTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;

use function K2gl\PHPUnitFluentAssertions\fact;

#[CoversMethod(className: FluentAssertions::class, methodName: 'matchesJsonFile')]
final class MatchesJsonFileTest extends FluentAssertionsTestCase
{
    public function testMatchesJsonFile(): void
    {
        // act
        fact('{"name":"Ada","id":42}')->matchesJsonFile(self::fixture());

        // assert
        $this->correctAssertionExecuted();
    }

    public function testFailsWhenDocumentDiffers(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('{"id":43,"name":"Ada"}')->matchesJsonFile(self::fixture());
    }

    public function testFailsWhenFileIsMissing(): void
    {
        // assert
        $this->incorrectAssertionExpected();

        // act
        fact('{"id":42}')->matchesJsonFile(__DIR__ . '/no-such-fixture.json');
    }

    private static function fixture(): string
    {
        return dirname(__DIR__, 3) . '/Fixtures/expected.json';
    }
}
