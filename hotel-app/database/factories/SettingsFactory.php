<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Settings;
use Faker\Generator as Faker;

$factory->define(Settings::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'city' => $faker->city,
        'country' => $faker->country,
        'state' => $faker->state,
        'zipcode' => $faker->postcode,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'image' => $faker->imageUrl( 640, 480)
    ];
});
