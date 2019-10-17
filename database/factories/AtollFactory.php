<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Atoll;
use Faker\Generator as Faker;

$factory->define(Atoll::class, function (Faker $faker) {
    return [
        'name' => $faker->city
    ];
});
