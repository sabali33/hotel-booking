<?php

use Illuminate\Database\Seeder;
use App\Room;
use App\RoomType;
use App\RoomCapacity;
use App\PriceManager;
class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        factory(Room::class, 10)->create()->each(function ($room){
            $range = range(1, 8);
            $rand = array_rand($range, 1) + 1;
	        $room->roomType()->associate(RoomType::find($rand));
	        $room->roomCapacity()->associate(RoomCapacity::find($rand));
	        $room->price()->save(PriceManager::find($rand));
            $room->save();
	    });
	    
    }
}
