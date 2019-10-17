<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Atoll;
use App\Island;
use App\School;
use Faker\Generator as Faker;

$factory->define(School::class, function (Faker $faker) {
    return [
        'name' => 'Baa Atoll Education Center',
        'atoll_id' => $faker->randomElement(Atoll::pluck('id')->toArray()),
        'island_id' => $faker->randomElement(Island::pluck('id')->toArray())

    ];
});
