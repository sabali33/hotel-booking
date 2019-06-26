<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Room;
use App\RoomType;
class RoomController extends Controller
{
	public function __construct(){
		//$this->middleware('auth');
	}
    public function index(){
    	$roomTypes = RoomType::all();
    	$rooms = Room::paginate(5);
    
    	return view('admin.rooms', compact('rooms', 'roomTypes') );
    }
    public function create(){
    	//var_dump($_POST->);
    	$data = request()->all();
    	$cleanData = request()->validate([
    		'name'=> 'required',
    		'image'=> '',
    		'type'=> ['required', 'integer'],
    		'price'=> ['required', 'integer'],
    		'capacity' => ['required', 'integer']
    	]);
    	$resp = Room::create([
    		'name'=> $cleanData['name'],
    		'room_image'=> 'n\a',
    		'room_type_id'=> $cleanData['type'],
    		'room_price_id'=> $cleanData['price'],
    		'room_capacity_id' => $cleanData['capacity']
    	]);
    	
    	return  $resp;
    }
}
