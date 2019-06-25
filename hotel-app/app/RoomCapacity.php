<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomCapacity extends Model
{
    public function rooms(){
    	return $this->hasMany(Room::class);
    }
}
