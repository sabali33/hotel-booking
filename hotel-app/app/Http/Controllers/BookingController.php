<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Booking;
use App\RoomType;
use App\Customer;
class BookingController extends Controller
{
    public function index(){
    	$roomTypes = RoomType::all();
    	$bookings = Booking::paginate(5);
    
    	return view('admin.bookings', compact('bookings', 'roomTypes') );
    }
    public function destroy(Booking $booking){
    	$deleted = $booking->delete();
    	$resp = [
    		'success' => $deleted,
    		'redirect' => '/bookings'
    	];
    	Session::flash('status', "{$booking->room->name} has been deleted!");
    	return $resp;
    }
    public function update( Booking $booking){
    	$data = request()->validate([
    		'start_date' => ['required', 'string'],
    		'end_date' => ['required', 'string'],
            'room_id' => ['integer'],
            'customer_id' => ['integer']
    	]);
        
        $saved = $booking->update($data);
        $booking->customer()->associate(Customer::find($data['customer_id']));
        $booking->save();
    	/*$booking->start_date = $data['start_date'];
    	$booking->end_date = $data['end_date'];
        $booking->room_id = $data['room_id'];
    	$saved = $booking->save();*/
        Session::flash('status', "Booking for{$booking->customer->name} has been updated");
        $resp = [
            'success' => $saved,
            'redirect' => '/bookings'
        ];
        return $resp;
    }
}
