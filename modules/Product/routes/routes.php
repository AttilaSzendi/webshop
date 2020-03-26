<?php

/** @var Illuminate\Routing\Router $router */
$router->middleware('auth')
    ->prefix('/admin/products')
    ->namespace('Modules\Product\Http\Controllers\Authorized')
    ->as('authorized::')
    ->group(function () use ($router) {
        $router->get('/', 'ProductController@show')
            ->name('product.show')
            ->middleware('permission:product.show');
    });

