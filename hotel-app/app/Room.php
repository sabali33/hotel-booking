<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function price(){
    	return $this->hasOne(PriceManager::class);
    }
    public function roomType(){
    	return $this->hasOne(RoomType::class);
    }
    public function roomCapacity(){
    	return $this->hasOne(RoomCapacity::class);
    }
    /*public function customer(){
    	return $this->hasMany(Customer::class);
    }*/
    public function bookings(){
        return $this->hasOne(Booking::class);
    }
}