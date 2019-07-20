<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\PriceManager;
use Faker\Generator as Faker;

$factory->define(PriceManager::class, function (Faker $faker) {
    return [
        'regular_price' =>$faker->randomFloat(2, 30, 2),
        'dynamic_price' =>$faker->randomFloat(2, 20, 2),
        'dynamic_price_expire_date' =>$faker->dateTimeBetween('+1day', '+7days'),
        'room_id' => $faker->randomDigitNotNull
    ];
});
