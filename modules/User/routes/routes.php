<?php

use Modules\User\Http\Controllers\Guest\Auth\VerifyEmailController;
use Modules\User\Http\Controllers\Guest\Auth\LoginController;
use Modules\User\Http\Controllers\Guest\Auth\RegisterController;
use Modules\User\Http\Controllers\UserController;

/** @var Illuminate\Routing\Router $router */
$router->post('/login', LoginController::class)
    ->name('login')
    ->middleware(['guest']);

$router->post('/registration', RegisterController::class)
    ->name('register')
    ->middleware(['guest']);

$router->get('/email/verify/{user}/{hash}', VerifyEmailController::class)
    ->name('email.verify')
    ->middleware(['guest', 'throttle:6,1']);

$router->resource('/users', UserController::class);
