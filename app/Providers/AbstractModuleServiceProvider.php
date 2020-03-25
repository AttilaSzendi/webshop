<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\CachesRoutes;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

abstract class AbstractModuleServiceProvider extends ServiceProvider
{
    /**
     * @param string $path
     */
    protected function loadRoutesFrom($path)
    {
        if (! ($this->app instanceof CachesRoutes && $this->app->routesAreCached())) {
            /** @var Router $router */
            $router = resolve('router');

            $router->middleware('api')->group(function() use ($path, $router) {
                require $path;
            });
        }
    }
}
