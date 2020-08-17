<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brewery;
use Faker\Generator as Faker;

$factory->define(Brewery::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'description' => $faker->text($maxNbChars = 200),
        'address' => $faker->address,
        'city' => $faker->city,
        'profile' => $name.'.png',
        
    ];
});
