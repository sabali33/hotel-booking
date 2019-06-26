<?php

use Illuminate\Database\Seeder;
use App\Settings;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Settings::class)->create();
    }
}
