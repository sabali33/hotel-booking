<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\PriceManager;
use Faker\Generator as Faker;

$factory->define(PriceManager::class, function (Faker $faker) {
    return [
        'regular_price' =>$faker->randomFloat(2, 150),
        'dynamic_price' =>$faker->randomFloat(2, 130),
        'dynamic_price_expire_date' =>$faker->unixTime(),
        'room_id' => $faker->randomDigitNotNull
    ];
});
