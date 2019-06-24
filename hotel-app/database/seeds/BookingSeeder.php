<?php

use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Booking::class, 10)->create()->each(function ($booking){
	        $booking->roomType()->save(factory(Room::class)->make());
	        $booking->roomCapacity()->save(factory(Customer::class)->make());
	        
	    });
    }
}
