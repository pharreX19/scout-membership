<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Atoll;
use App\Island;
use Faker\Generator as Faker;

$factory->define(Island::class, function (Faker $faker) {
    return [
        'name' => 'Eydhafushi',
        'atoll_id' => $faker->randomElement(Atoll::pluck('id')->toArray())
    ];
});
