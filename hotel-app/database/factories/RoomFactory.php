<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Room;
use App\RoomType;
use App\RoomCapacity;
use App\PriceManager;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name' =>$faker->unique()->text,
        'room_image' => $faker->imageUrl(640, 480),
        'room_type_id' => function () {
            return factory(App\RoomType::class)->create()->id;
        },
        'room_capacity_id'=> function () {
            return factory(App\RoomCapacity::class)->create()->id;
        },
        'room_price_id' => function () {
            return factory(App\PriceManager::class)->create()->id;
        },
        
    ];
});
