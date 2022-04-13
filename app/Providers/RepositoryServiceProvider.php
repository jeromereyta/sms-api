<?php

namespace App\Providers;

use App\Repositories\Interfaces\EloquentRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            EloquentRepositoryInterface::class => BaseRepository::class,
            RoleRepositoryInterface::class => RoleRepository::class,
            UserRepositoryInterface::class => UserRepository::class,
        ];

        foreach ($repositories as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
