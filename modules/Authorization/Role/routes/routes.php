<?php

/**
 * @var Illuminate\Routing\Router $router
 */
$router->middleware('auth')
    ->namespace('Modules\Authorization\Role\Http\Controllers\Admin')
    ->prefix('/admin')
    ->as('admin::')->group(function () use ($router) {
        $router->get('/roles', 'RoleIndexController')
            ->name('role-index')
            ->middleware('permission:role-index');

        $router->get('/roles', 'RoleIndexController')
            ->name('role-index')
            ->middleware('permission:role-index');

        $router->post('/attach-permission', 'RoleSyncPermissionsController')
            ->name('sync-permissions')
            ->middleware('permission:sync-permissions');
    });
