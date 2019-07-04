<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceManager extends Model
{
	protected $guarded = [];
    public function room(){
    	return $this->belongsTo(Room::class);
    }
    protected static function boot(){
    	parent::boot();
        
    }
}
