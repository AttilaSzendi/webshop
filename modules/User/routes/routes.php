<?php

use Modules\User\Http\Controllers\UserController;

/** @var Illuminate\Routing\Router $router */
$router->resource('/users', UserController::class)->middleware('api');
