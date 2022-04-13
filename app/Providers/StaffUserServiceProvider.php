<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\StaffUser\Factories\StaffUserFactory;
use App\Services\StaffUser\Interfaces\StaffUserFactoryInterface;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class StaffUserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $services = [
            StaffUserFactoryInterface::class => StaffUserFactory::class,
        ];

        foreach ($services as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
