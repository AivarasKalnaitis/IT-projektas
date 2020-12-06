<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InsurancePlan;
use Faker\Generator as Faker;

$factory->define(InsurancePlan::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->randomFloat(null,1,100),
        'years_of_experience' => $faker->numberBetween(1,10),
        'insurance_covered_events' => $faker->word . ',' . $faker->word . ',' . $faker->word,
    ];
});
