<?php

namespace Modules\User;

use App\Providers\AbstractModuleServiceProvider;
use Modules\User\Contracts\Repositories\UserRepositoryInterface;
use Modules\User\Repositories\UserRepository;

class UserServiceProvider extends AbstractModuleServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(
            __DIR__ . '/../routes/routes.php'
        );

        $this->loadMigrationsFrom(
            __DIR__ . '/../database/migrations'
        );

        $this->loadFactoriesFrom(
            __DIR__ . '/../database/factories'
        );
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/user.php',
            'informationPage'
        );

        $this->app->register(UserEventServiceProvider::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
