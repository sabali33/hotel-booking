<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name' =>$faker->unique()->text,
        'room_image' => $faker->imageUrl(640, 480),
        'room_type_id' => $faker->randomDigitNotNull,
        'room_capacity_id'=>$faker->randomDigitNotNull,
        'room_price_id' => $faker->randomDigitNotNull
        
    ];
});
