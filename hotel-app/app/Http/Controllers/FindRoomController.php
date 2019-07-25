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
    	$data = request()->validate([
            'room_type' => 'nullable|integer',
            'start_date' => 'nullable|string',
            'end_date' => 'nullable|string'
        ]);
        
    	$room_type_id = request('room_type');
        $today = new DateTime();
    	$in =  new DateTime(request('start_date'));

    	$out = request('end_date') ? new DateTime(request('end_date')) : $today->modify('+1 Day');

    	$roomType = $room_type_id ? RoomType::find( $room_type_id ) : null;
        
        $rooms = $roomType ? $roomType->rooms : Room::all();

    	$rooms = $rooms->filter(function($room) use($in, $out) {
    		if(!$room->bookings->count()){
                return $room;
            }
            $daysBooked = $room->isBooked($in->format('Y-m-d'));
            
            return !$daysBooked;
    	});
        $dates = collect([
            'in' => $in,
            'out' => $out,
            'nights' => $out->diff($in),
        ]);
    	
    	return view('archive', compact('rooms', 'dates'));
    }
}
