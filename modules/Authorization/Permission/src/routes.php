<?php

/**
 * @var Illuminate\Routing\Router $router
 */
$router->namespace('Modules\Authorization\Permission\Http\Controllers')
    ->prefix('/permissions')
    ->group(function () use ($router) {
        $router->get('/', 'PermissionIndexController')
            ->name('permission-index')
            ->middleware('permission:permission-index');
    });
