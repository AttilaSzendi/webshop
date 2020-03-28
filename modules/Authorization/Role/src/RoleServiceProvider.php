<?php

namespace Modules\Authorization\Role;

use App\Providers\ModuleServiceProvider;
use Modules\Authorization\Role\Contracts\Repositories\RoleRepositoryInterface;
use Modules\Authorization\Role\Contracts\Services\UserRoleHandlerInterface;
use Modules\Authorization\Role\Repositories\RoleRepository;
use Modules\Authorization\Role\Services\UserRoleHandler;

class RoleServiceProvider extends ModuleServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations');
        $this->loadRoutesFromModule(__DIR__ . DIRECTORY_SEPARATOR . 'routes.php');
        $this->loadFactoriesFrom(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'factories');
    }

    public function register()
    {
        $this->app->register(RoleEventServiceProvider::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(UserRoleHandlerInterface::class, UserRoleHandler::class);
    }
}
