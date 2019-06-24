<?php

namespace App\Http\Controllers;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
class FindRoomController extends Controller
{
    public function index(){
    	//dd(request()->all());
    	$rooms = Room::all()->reject(function($room){
    		$date = new DateTime($room->bookings->start_date);
    		$w = $date->format('Y-m-d');
    		return $room->bookings ? false : true;
    	});
    	$date = new DateTime($rooms->first()->bookings->start_date);
    	$w = $date->format('Y-m-d');
    	dd($w);
    }
}
