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
	        $room->roomType()->save(factory(RoomType::class)->make());
	        $room->roomCapacity()->save(factory(RoomCapacity::class)->make());
	        $room->price()->save(factory(PriceManager::class)->make());
	    });
	    /*$this->call([
	    	RoomType::class,
	    	RoomCapacity::class,
	    	PriceManager::class
	    ]);*/
    }
}
