<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Exception;
use App\Room;
use App\RoomType;
use App\PriceManager;
class RoomController extends Controller
{
	public function __construct(){
		//$this->middleware('auth');
	}
    public function index(){
        $this->authorize('view', Room::class);
    	$roomTypes = RoomType::all();
    	$rooms = Room::paginate(5);
        $jsonRooms = $rooms->toJson();
    	return view('admin.rooms', compact('rooms', 'roomTypes', 'jsonRooms') );
    }
    public function create(){

        Session::forget('status');
        if(!Gate::allows('isAdmin', Room::class)){
            Session::flash('status', "You are not authorized!");
            return [
                'success'=> false,
                'redirect' => '/rooms'
            ];
        }
    	
    	$data = request()->all();

    	$cleanData = request()->validate([
    		'name'=> 'required',
    		'image'=> 'required|string',
    		'type'=> ['required', 'integer'],
    		'price'=> ['required', 'integer'],
    		'capacity' => ['required', 'integer']
    	]);
        $explodedImage = explode(',', $cleanData['image']);
        $image = base64_decode($explodedImage[1]);
        if(!str_contains($explodedImage[0], ['jpg', 'jpeg', 'gif', 'png', 'webp'])){
            throw new Exception('image format not right');
        }
        $explodedExt = explode('/', $explodedImage[0]);
        $explodedExt = explode(';', $explodedExt[1]);
        $ext = $explodedExt[0];

        $filename = str_slug($cleanData['name']).'.'.$ext;
        $path = public_path('storage/images').'/'.$filename;
        $stored = file_put_contents($path, $image);
        
    	$room = Room::create([
    		'name'=> $cleanData['name'],
    		'room_image'=> $filename,
    		'room_type_id'=> $cleanData['type'],
    		'price_manager_id'=> $cleanData['price'],
    		'room_capacity_id' => $cleanData['capacity']
    	]);
        $price = PriceManager::find($cleanData['price']);
        $room->price()->associate($price);
        $room->save();
        Session::flash( 'status', "{$room['name']} as been added!" );
    	$room['redirect'] = '/rooms';

    	return  $room;
    }
    public function destroy( Room $room ){
        $deleted = $room->delete();
        $room->bookings()->each(function($booking){
            $booking->delete();
        });
        if($deleted){
            Session::flash('status', "{$room->name} has been deleted");
        }else{
            Session::flash('status', "{$room->name} could not be deleted");
        }
        
        return redirect('/rooms');//->with('status', array($this, "respond")) : redirect('/');
    }
    public function respond(){
        return `Room has been deleted`;
    }
    public function update( Room $room ){
        
        Session::forget('status');
        
        if(!Gate::allows('isAdmin', Room::class)){
            Session::flash('status', "You are not authorized!");
            return [
                'success'=> false,
                'redirect' => '/rooms'
            ];
        }

        $data = request()->validate([
            'type' => 'required',
            'price' => [ 'required', 'integer'],
            'name' => 'required',
            'capacity' => [ 'required', 'integer'],
            
            'image' => ''
        ]);
        $results = $room->update([
            'name' => $data['name'],
            'price_manager_id' => $data['price'],
            'room_type_id' => $data['type'],
            'room_capacity_id' => $data['capacity'],
            'room_image' => request('image') ? request('image') : $room->room_image

        ]);
        $room->roomType()->associate($data['type']);
        $room->roomCapacity()->associate($data['capacity']);
        $room->price()->associate(PriceManager::find($data['price']));
        $room->save();
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
    public function isAllowed(){
        if(!Gate::allows('isAdmin', Room::class)){
            Session::flash('status', "You are not authorized!");
            return [
                'success'=> false,
                'redirect' => '/rooms'
            ];
        }
    }
}
