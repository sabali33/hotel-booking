<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Booking;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'room_id' => $faker->randomDigitNotNull,
        'customer_id' => $faker->randomDigitNotNull,
        'end_date'  => $faker->unixTime,
        'start_date' => $faker->unixTime
    ];
});
