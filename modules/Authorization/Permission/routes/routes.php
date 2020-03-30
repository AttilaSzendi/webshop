<?php

use Modules\Authorization\Permission\Http\Controllers\PermissionIndexController;

/** @var Illuminate\Routing\Router $router */
$router->get('/permissions', PermissionIndexController::class)
    ->name('permission-index')
    ->middleware('permission:permission-index');

