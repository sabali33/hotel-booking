<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Customer;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //dd(User::class);
        factory(User::class, 10)->create()->each(function (User $user){
	        $user->customer()->save(factory(Customer::class)->make());
	        
	        
	    });
    }
}
