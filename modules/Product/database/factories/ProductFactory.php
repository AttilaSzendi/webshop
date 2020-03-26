<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Modules\Product\Models\Product;

/** @var Factory $factory */
$factory->define(Product::class, function (Faker $faker) {
    return [
        'price' => $faker->numberBetween(1, 10)
    ];
});
