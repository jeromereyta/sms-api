<?php

declare(strict_types=1);

namespace App\Exceptions\Interfaces;

use Sentry\Severity;
use Throwable;

interface SentryHandlerInterface
{
    public function log(string $message, ?Severity $level = null);

    public function reportError(Throwable $throwable);
}
