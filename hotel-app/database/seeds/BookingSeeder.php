<?php

use Illuminate\Database\Seeder;
use App\Booking;
use App\Room;
use App\Customer;

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
        	//dd( factory(Customer::class)->make() );
        	$booking->customer()->associate(factory(Customer::class)->make());
	        $booking->customer()->associate(factory(Room::class)->make());
	        //$booking->save();
	        
	    });
    }
}
