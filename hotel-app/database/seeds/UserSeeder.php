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
        
        factory(User::class, 10)->create()->each(function (User $user){
            $customer = factory(Customer::class)->make([ 'user_id' => $user->id,]);//Customer::findornew($user->id)
            if($user->id == 1){
                $user->email = 'admin@test.com';
                $user->save();
                $user->push();
            }
	        $user->customer()->save($customer);
	        
	        
	    });
    }
}
