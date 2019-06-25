<?php

namespace App\Http\Controllers;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
class FindRoomController extends Controller
{
    public function index(){
    	
    	$roomType = request('room_type');
    	$in = new DateTime(request('from'));
    	$out = new DateTime(request('to'));
    	$rooms = Room::all()->where( 'room_type_id', $roomType);

    	$rooms = $rooms->filter(function($room) use($in, $out) {
    		if(!$room->bookings->count()){
                return $room;
            }
            $daysBooked = $room->isBooked($in->format('Y-m-d'));
            
            return !$daysBooked;
    	});

    	
    	return $rooms->toJson();
    }
}
