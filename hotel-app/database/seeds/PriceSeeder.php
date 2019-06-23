<?php

use Illuminate\Database\Seeder;

use App\PriceManager;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PriceManager::class, 10)->create();
    }
}
