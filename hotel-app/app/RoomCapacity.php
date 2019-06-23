<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomCapacity extends Model
{
    public function room(){
    	return $this->belongsTo(App\Room::class);
    }
}
