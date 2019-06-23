<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\RoomCapacity;
use Faker\Generator as Faker;

$factory->define(RoomCapacity::class, function (Faker $faker) {
    return [
        'name' =>$faker->unique()->text,
        'description' =>$faker->text,
        'room_id' => $faker->randomDigitNotNull
    ];
});
