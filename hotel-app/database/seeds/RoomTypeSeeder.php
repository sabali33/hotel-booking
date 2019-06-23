<?php

use Illuminate\Database\Seeder;

use App\RoomType;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RoomType::class, 10)->create();
    }
}
