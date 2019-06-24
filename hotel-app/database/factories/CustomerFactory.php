<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Customer;
use App\User;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address' => $faker->address,
        'city' => $faker->city,
        'country' => $faker->country,
        'state' => $faker->state,
        'postcode' => $faker->postcode,
        'phone' => $faker->phoneNumber,
        'user_id' => $faker->randomDigitNotNull
    ];
});
