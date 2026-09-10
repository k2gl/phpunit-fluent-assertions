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
     * that substring. Pass `$inspect` to assert on the exception itself — it
     * receives the thrown instance, so a status code or a payload can be checked
     * with ordinary fact() calls.
     *
     * Example usage:
     * fact(fn () => throw new RuntimeException('boom'))->throws(RuntimeException::class);
     * fact(fn () => $service->run())->throws(DomainException::class, 'invalid');
     * fact(fn () => $client->get())->throws(HttpException::class, inspect: fn (HttpException $e) => fact($e->status)->is(404));
     *
     * @param class-string<Throwable> $exception
     * @param (callable(Throwable): void)|null $inspect
     */
    public function throws(string $exception, string $message = '', ?callable $inspect = null): self
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

            if ($inspect !== null) {
                $inspect($thrown);
            }

            return $this;
        }

        Assert::fail(sprintf('Failed asserting that "%s" was thrown.', $exception));
    }

    /**
     * Asserts that calling the subject (a callable) completes without throwing.
     *
     * Example usage:
     * fact(fn () => $policy->check($certificate))->doesNotThrow();
     */
    public function doesNotThrow(string $message = ''): self
    {
        $subject = $this->variable;

        if (! is_callable($subject)) {
            Assert::fail('doesNotThrow() expects the subject to be a callable.');
        }

        try {
            $subject();
        } catch (Throwable $thrown) {
            Assert::fail(sprintf(
                '%sFailed asserting that nothing was thrown, got %s: %s',
                $message === '' ? '' : $message . "\n",
                $thrown::class,
                $thrown->getMessage(),
            ));
        }

        // Counted as an assertion so a test consisting of this check alone is not risky.
        Assert::assertThat(true, Assert::isTrue(), $message);

        return $this;
    }
}
