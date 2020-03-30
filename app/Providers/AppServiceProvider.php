<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Authorization\Permission\PermissionServiceProvider;
use Modules\Authorization\Role\RoleServiceProvider;
use Modules\Product\ProductServiceProvider;
use Modules\User\UserServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(UserServiceProvider::class);
        $this->app->register(ProductServiceProvider::class);
        $this->app->register(PermissionServiceProvider::class);
        $this->app->register(RoleServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
