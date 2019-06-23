<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceManagerController extends Controller
{
    //
    public function room(){
    	return $this->belongsTo( Room::class );
    }
}
