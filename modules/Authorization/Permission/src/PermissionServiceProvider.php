<?php

namespace Modules\Authorization\Permission;

use App\Providers\AbstractModuleServiceProvider;
use Modules\Authorization\Permission\Contracts\Repositories\PermissionEloquentRepositoryInterface;
use Modules\Authorization\Permission\Repositories\PermissionEloquentRepository;

class PermissionServiceProvider extends AbstractModuleServiceProvider
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
        $this->app->bind(
            PermissionEloquentRepositoryInterface::class,
            PermissionEloquentRepository::class
        );
    }
}
