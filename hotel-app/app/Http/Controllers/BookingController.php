<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CustomerController;
use App\Booking;
use App\RoomType;
use App\Room;
use App\Customer;
use App\User;
use DateTime;
class BookingController extends Controller

{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
    	$roomTypes = RoomType::all();

    	$customerBookings = Booking::where('customer_id', '=', auth()->user()->id)->paginate(5);
        $allBookings = Booking::paginate(5);
        $bookings  = auth()->user()->id == 1 ? $allBookings : $customerBookings;
        $allBookedDays = $bookings->map(function($booking){
            return array( 
                'customer' => $booking->customer->first_name,
                'dates' => $booking->getBookedDays(),
                //'end_date' => $booking->end_date
            );
            //return $booking->getBookedDays();
        });
        //$allBookedDays = $allBookedDays->flatten(1);
        //dd($allBookedDays);
        //$allBookedDays->all();
    	return view('admin.bookings', compact('bookings', 'roomTypes', 'allBookedDays') );
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
    	
        Session::flash('status', "Booking for{$booking->customer->name} has been updated");
        $resp = [
            'success' => $saved,
            'redirect' => '/bookings'
        ];
        return $resp;
    }
    public function create(){
        
        $userData = Validator::make( request('user'), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['email'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'country' => '',

        ]);
        if($userData->fails()){
            Session::flash('status', 'Sorry, there is was a validation error!');
            return [
                'redirect' => '/',
                'success' =>false,
                //'data' => $userData
            ];
        }

        $bookingData = Validator::make(request('booking'), [
            'room_id' => 'integer',
            'start_date' => 'string|required',
            'end_date' => 'string|required',
            'amount' => 'numeric'
        ]);
        if($bookingData->fails()){
            Session::flash('status', 'Sorry, there is was a validation error!');
            return [
                'redirect' => '/',
                'success' => false,
                //'data' => $bookingData
            ];
        }
        $userData = request('user');
        $bookingData = request('booking');
        $amount = $bookingData['amount'];
        unset($bookingData['amount']);
        $in = new DateTime($bookingData['start_date']);
        $out = new DateTime($bookingData['end_date']);

        $bookingData['start_date'] = $in->format('Y-m-d');
        $bookingData['end_date'] = $out->format('Y-m-d');

        $userData['password'] = bcrypt('secret');
        $userData['name'] = $userData['first_name'].' '.$userData['last_name'];

        $room = Room::find($bookingData['room_id']);
        
        $booked = $room->isBooked($in->format('Y-m-d'));
        
        if($booked){
            Session::flash('status', "{$room->name} is already booked between {$bookingData['start_date']} and {$bookingData['end_date']}");
            return [
                'success' => false,
                'redirect' => '/',
                'message' => "{$room->name} is already booked"
            ];
        }
        DB::beginTransaction();
        $user = User::where('email', '=', $userData['email'])->first();
        if(!$user){
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password']
            ]);

            $customer = $user->customer()->create([
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'address' => $userData['address'],
                'city' => $userData['city'],
                'country' => $userData['country'],

            ]);
        }else{
            $customer = Customer::find($user->id);
        }
        
            
        $bookingData['customer_id'] = $customer->id;
        $booking = Booking::create($bookingData);
        //process payment
        
        if(!$booking) {
            DB:rollBack();
        }
        DB::commit();
        
        
       
        
        Session::flash('status', "{$customer->first_name}, your booking has been successful");
        return [
            'success' => $booking,
            'redirect' => '/'
        ];
        

    }
}
