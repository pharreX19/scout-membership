<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    $roles = ['admin','user'];
    for($i = 0; $i<count($roles); $i++){
        return [
            'name' => $roles[$i]
        ];
    }

});
