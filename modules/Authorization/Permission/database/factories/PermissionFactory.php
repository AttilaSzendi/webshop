<?php

use Faker\Generator as Faker;
use Modules\Authorization\Permission\Model\Permission;

/** @var $factory Illuminate\Database\Eloquent\Factory */
$factory->define(Permission::class, function (Faker $faker) {
    return [
        'key' => $faker->unique()->word
    ];
});
