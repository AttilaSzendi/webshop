<?php

use Modules\User\Http\Controllers\Free\Auth\LoginController;
use Modules\User\Http\Controllers\Free\Auth\RegisterController;
use Modules\User\Http\Controllers\UserController;

/** @var Illuminate\Routing\Router $router */
$router->post('/login', LoginController::class)
    ->name('login')
    ->middleware(['guest']);

$router->post('/registration', RegisterController::class)
    ->name('register')
    ->middleware(['guest']);

$router->resource('/users', UserController::class);
