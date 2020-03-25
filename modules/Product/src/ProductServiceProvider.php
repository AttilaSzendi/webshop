<?php

namespace Modules\Product;

use App\Providers\AbstractModuleServiceProvider;

class ProductServiceProvider extends AbstractModuleServiceProvider
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
            __DIR__ . '/../config/product.php',
            'product'
        );
    }
}
