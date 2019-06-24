<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function bookings(){
    	return $this->hasMany(Room::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
