<?php

declare(strict_types=1);

namespace App\Providers;

use App\Exceptions\Interfaces\SentryHandlerInterface;
use App\Exceptions\SentryHandler;
use Illuminate\Support\ServiceProvider;

final class ErrorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $services = [
            SentryHandlerInterface::class => SentryHandler::class,
        ];

        foreach ($services as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
