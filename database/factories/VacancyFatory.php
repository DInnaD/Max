<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vacancy;
use Faker\Generator as Faker;

$factory->define(Vacancy::class, function (Faker $faker) {
    return [
        //
		'vacancy_name' => $faker->lastName(),
        'workers_amount' => $faker->numberBetween(1, 50),
        'organization_id' => $faker->numberBetween(1, 50),  
        'salary' => $faker->numberBetween(70000, 100000),
    ];
});
