<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	/*protected $fillable = [
       'first_name'
    ];*/
    public function bookings(){
    	return $this->hasOne(Booking::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
