<?php

namespace Modules\Authorization\Permission;

use App\Providers\ModuleServiceProvider;
use Modules\Authorization\Permission\Contracts\Repositories\PermissionEloquentRepositoryInterface;
use Modules\Authorization\Permission\Repositories\PermissionEloquentRepository;

class PermissionServiceProvider extends ModuleServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations');
        $this->loadRoutesFromModule(__DIR__ . DIRECTORY_SEPARATOR . 'routes.php');
        $this->loadFactoriesFrom(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'factories');
    }

    public function register()
    {
        $this->app->bind(
            PermissionEloquentRepositoryInterface::class,
            PermissionEloquentRepository::class
        );
    }
}
