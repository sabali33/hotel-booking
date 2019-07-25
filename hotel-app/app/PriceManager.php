<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceManager extends Model
{
	protected $guarded = [];
    public function rooms(){
    	return $this->hasMany(Room::class);
    }
    /*protected static function boot(){
    	parent::boot();
        
    }*/
}
