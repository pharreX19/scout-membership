<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'id_number' => 'A'.mt_rand(),
        'birth_date' => '2019-09-01',
        'address' => $faker->address,
        'contact' => '7777777',
        'email' => $faker->unique()->safeEmail,
        'joined_date' => $faker->date('Y-m-d'),
        'is_approved' => 0,
        'atoll_id' => $faker->randomElement(\App\Atoll::pluck('id')->toArray()),
        'island_id'=> $faker->randomElement(\App\Island::pluck('id')->toArray()),
        'school_id'=> $faker->randomElement(\App\School::pluck('id')->toArray()),
        'user_id'=> $faker->randomElement(\App\User::pluck('id')->toArray()),
        'rank_id' => $faker->randomElement(\App\Rank::pluck('id')->toArray())
    ];
});
