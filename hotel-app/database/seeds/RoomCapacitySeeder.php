<?php

use Illuminate\Database\Seeder;
use App\RoomCapacity;
class RoomCapacitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RoomCapacity::class, 10)->create()
    }
}
