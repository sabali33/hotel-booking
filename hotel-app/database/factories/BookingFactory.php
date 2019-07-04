<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Booking;
use App\Room;
use App\Customer;
use Faker\Generator as Faker;
//use \DateTime;
$factory->define(Booking::class, function (Faker $faker) {
	$in = array_rand(array_values(range( 1, 7))) || 2;
	$out = array_rand(array_values(range(1, 5)));
	
	$min_max = $in+1;
	$max_end = $out+$min_max;
    $roomNumbers = array_values(range( 1, 4));
    $rNumber = array_rand($roomNumbers, 1);
    $room = Room::find($rNumber);
    return [
        'room_id' => function () use($rNumber) {
            return $rNumber;
        },
        'customer_id' => function () {
        	$customers = range( 1, 10);
            return array_rand($customers, 1);
        },
        'start_date'  => function() use($room, $in, $faker){
            $date = $faker->dateTimeBetween( "+1day", "+{$in}days"  );
            
            $dayIsBookedAlready = $room ? $room->isBooked($date->format('Y-m-d')) : false;

            if(!$dayIsBookedAlready){
                return $date;
            }

            $lastBookedDate = $room->getLastBookedDate();

            $lDateTime = new DateTime($lastBookedDate);
            $lDateTime->modify('+1 day');

            return $dateTime->format('Y-m-d');

            
        },
        'end_date' => $faker->dateTimeBetween( "+{$min_max}day", "+{$max_end}days")
    ];
});
