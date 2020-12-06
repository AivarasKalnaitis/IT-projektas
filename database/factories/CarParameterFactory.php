<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CarParameter;
use Faker\Generator as Faker;

$factory->define(CarParameter::class, function (Faker $faker) {
    return [
        'parameter' => $faker->word,
        'value' => $faker->word,
    ];
});
