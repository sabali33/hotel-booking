<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Booking;
use App\Room;
use App\Customer;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
	
    return [
        'room_id' => function () {
        	$rooms = range( 1, 4);
        	//dd(App\Room::find(array_rand($rooms, 1))->id);
            return array_rand($rooms, 1);
        },
        'customer_id' => function () {
        	$customers = range( 5, 10);
            return array_rand($customers, 1);
        },
        'end_date'  => $faker->unixTime,
        'start_date' => $faker->unixTime
    ];
});
