<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


use App\Room;
use App\RoomType;
use App\PriceManager;
class RoomController extends Controller
{
	public function __construct(){
		//$this->middleware('auth');
	}
    public function index(){
        //dd(Input::file('file'));
    	$roomTypes = RoomType::all();
    	$rooms = Room::paginate(5);
        $jsonRooms = $rooms->toJson();
    	return view('admin.rooms', compact('rooms', 'roomTypes', 'jsonRooms') );
    }
    public function create(){
    	Session::forget('status');
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
        Session::flash( 'status', "{$resp['name']} as been added!" );
    	$resp['redirect'] = '/rooms';
    	return  $resp;
    }
    public function destroy( Room $room ){
        $room->delete();
        return redirect('rooms')->with('status', array($this, "respond"));
    }
    public function respond(){
        return "{$this->name} has been deleted";
    }
    public function update( Room $room ){
        //Request::session();
        Session::forget('status');
       /* $file = $room->input('data');//Input::file('image');
        //$filename = $file->getClientOriginalName();
        return $file;*/

        $data = request()->validate([
            'type' => 'required',
            'price' => [ 'required', 'integer'],
            'name' => 'required',
            'capacity' => [ 'required', 'integer'],
            
            'image' => ''
        ]);
        $results = $room->update([
            'name' => $data['name'],
            'room_price_id' => $data['price'],
            'room_type_id' => $data['type'],
            'room_capacity_id' => $data['capacity'],
            'room_image' => request('image') ? request('image') : $room->room_image

        ]);
        //$room->roomType()->associate($data['type']);
        //$room->roomCapacity()->associate($data['capacity']);
        $room->price()->save(PriceManager::find($data['price']));

        Session::flash('status', "{$room->name} as been updated!");
        $resp['redirect'] = '/rooms';
        $resp['success'] = true;
        return  $resp;
    }
    public function json(Room $room){
        return $room;
    }
    public function upload( Request $request ){
        $file = $request->all();
        return ['sucess' =>$file];
        
    }
    public function getAll(){
        return Room::all()->toJson();
    }
}
