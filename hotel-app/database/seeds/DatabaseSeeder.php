<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingsSeeder::class,
	        UserSeeder::class,
	        RoomTypeSeeder::class,
	        RoomCapacitySeeder::class,
	        PriceSeeder::class,
	        RoomSeeder::class,
	        BookingSeeder::class,
	    ]);
    }
}
