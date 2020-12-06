<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderedInsurance;
use Faker\Generator as Faker;

$factory->define(OrderedInsurance::class, function (Faker $faker) {
    return [
        'approved' => $faker->boolean,
        'user_id' => function () {
            return App\User::inRandomOrder()->first()->id;
        },
        'insurance_id' => function () {
            return App\InsurancePlan::inRandomOrder()->first()->id;
        }
    ];
});
