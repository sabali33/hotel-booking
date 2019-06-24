<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function room(){
    	return $this->belongsTo(Room::class);
    }
    public function customer(){
    	return $this->belongsTo(Customer::class);
    }
}
