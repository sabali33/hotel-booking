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
        	$range = range(2, 5);
            $id = array_rand($range, 1) + 1;
            //dd(Customer::find($id), $id);
            $booking->customer()->associate(Customer::find($id)); //
        	$booking->room()->associate(Room::find($id));
	        
	        $booking->save();
	        
	    });
    }
}
