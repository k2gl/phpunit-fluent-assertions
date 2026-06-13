<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Traits;

use PHPUnit\Framework\Assert;
use Throwable;

/**
 * @phpstan-require-extends \K2gl\PHPUnitFluentAssertions\FluentAssertions
 */
trait ExceptionAssertions
{
    /**
     * Asserts that calling the subject (a callable) throws the given exception.
     *
     * Pass a non-empty `$message` to also assert that the thrown message contains
     * that substring.
     *
     * Example usage:
     * fact(fn () => throw new RuntimeException('boom'))->throws(RuntimeException::class);
     * fact(fn () => $service->run())->throws(DomainException::class, 'invalid');
     *
     * @param class-string<Throwable> $exception
     */
    public function throws(string $exception, string $message = ''): self
    {
        $subject = $this->variable;

        if (! is_callable($subject)) {
            Assert::fail('throws() expects the subject to be a callable.');
        }

        try {
            $subject();
        } catch (Throwable $thrown) {
            Assert::assertInstanceOf($exception, $thrown);

            if ($message !== '') {
                Assert::assertStringContainsString($message, $thrown->getMessage());
            }

            return $this;
        }

        Assert::fail(sprintf('Failed asserting that "%s" was thrown.', $exception));
    }
}
