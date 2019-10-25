<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Atoll;
use App\Island;
use App\School;
use Faker\Generator as Faker;

$factory->define(School::class, function (Faker $faker) {
    return [
        'name' => 'Baa Atoll Education Center',
        'atoll_id' => 3,
        'island_id' => 34

    ];
});
