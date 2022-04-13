<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Interfaces\SentryHandlerInterface;
use Sentry\Severity;
use Throwable;

final class SentryHandler implements SentryHandlerInterface
{
    public function log(string $message, ?Severity $level = null)
    {
        $level = $level ?? new Severity(Severity::INFO);

        \Sentry\captureMessage($message, $level);
    }

    public function reportError(Throwable $throwable)
    {
        \Sentry\captureException($throwable);
    }
}
