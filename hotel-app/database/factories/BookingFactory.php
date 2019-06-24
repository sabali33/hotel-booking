<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Booking;
use App\Room;
use App\Customer;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
	$in = array_rand(range( 1, 7));
	$out = array_rand(range(1, 5));
	$max_end = $out+$in;
	$min_max = $in+1;
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
        'end_date'  => $faker->dateTimeBetween( "+{$min_max}day", "+{$max_end}days" ),
        'start_date' => $faker->dateTimeBetween( "+1day", "+{$in}days" )
    ];
});
