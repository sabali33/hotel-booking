<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\RoomType;
use Faker\Generator as Faker;

$factory->define(RoomType::class, function (Faker $faker) {
    return [
        'name' =>$faker->unique()->secondaryAddress,
        'description' =>$faker->text,
        'room_id' => $faker->randomDigitNotNull
    ];
});
