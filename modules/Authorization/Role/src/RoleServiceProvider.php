<?php

namespace Modules\Authorization\Role;

use App\Providers\AbstractModuleServiceProvider;
use Modules\Authorization\Role\Contracts\Repositories\RoleRepositoryInterface;
use Modules\Authorization\Role\Contracts\Services\UserRoleHandlerInterface;
use Modules\Authorization\Role\Repositories\RoleRepository;
use Modules\Authorization\Role\Services\UserRoleHandler;

class RoleServiceProvider extends AbstractModuleServiceProvider
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
        $this->app->register(RoleEventServiceProvider::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(UserRoleHandlerInterface::class, UserRoleHandler::class);
    }
}
