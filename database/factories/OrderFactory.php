<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\Brewery;
use App\Beer;
use App\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'bill' => $faker->unique(),
        'brewery_id' => Brewery::inRandomOrder()->value('id'),
        
    ];
});
