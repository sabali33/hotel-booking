<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function bookings(){
    	return $this->hasMany(Booking::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
