<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\CachesRoutes;
use Illuminate\Support\ServiceProvider;

abstract class AbstractModuleServiceProvider extends ServiceProvider
{
    /**
     * @param string $path
     */
    protected function loadRoutesFrom($path)
    {
        if (! ($this->app instanceof CachesRoutes && $this->app->routesAreCached())) {
            $router = $this->app['router'];

            require $path;
        }
    }
}
