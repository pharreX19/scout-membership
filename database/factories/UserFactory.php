<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => 'Admin',
        'last_name' => 'Admin',
        'email' => 'admin@admin.com',
        'contact' => '7654321',
        'atoll_id' => 3,
        'island_id' => 3,
        'school_id' => 1,
        'role_id'=> 1,
        // 'is_approved' => 1,
        'email_verified_at' => now(),
        'password' => 'pa55w.rd', // password
        'remember_token' => Str::random(10),
    ];
});
