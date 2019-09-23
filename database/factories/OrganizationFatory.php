<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Organization;
use Faker\Generator as Faker;

$factory->define(Organization::class, function (Faker $faker) {
    return [
        'title'  => $faker->sentence(4, true),
        'country' => $faker->country(),
        'city' => $faker->city(),  
        'creator_id' =>$faker->numberBetween(2, 50), 

    ];
});
