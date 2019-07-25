<?php

namespace App\Http\Controllers;
use App\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoomTypeController extends Controller
{
    public function index(){
    	//$roomTypes = RoomType::where('rooms')->paginate(10);
    	$roomTypes = RoomType::paginate(10);
        
    	return view('admin.room-types', compact( 'roomTypes') );
    }
    public function json(){
    	return RoomType::all();
    }
    public function create(){
        $this->authorize('update', RoomType::class);
    	$data = request()->validate([
    		'name' => ['required', 'string'],
    		'description' => ['required', 'string']
    	]);
    	
    	$roomType = RoomType::create($data);
    	
    	Session::flash('status', "{$roomType->name} has been added!");
    	return redirect('room-types');
    }
    public function destroy(RoomType $type){
        $this->authorize('delete', $type);
    	$deleted = $type->delete();
    	$resp = [
    		'success' => $deleted,
    		'redirect' => '/room-types',
    	];
        Session::flash('status', "{$type->name} has been deleted!");
    	return $resp;
    }
}
