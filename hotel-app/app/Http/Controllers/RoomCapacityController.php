<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomCapacity;
use Illuminate\Support\Facades\Session;
class RoomCapacityController extends Controller
{
    public function index(){
    	$roomCapacities = RoomCapacity::paginate(5);
        $collection = collect($roomCapacities)->toArray();
    	//dd($collection['data']);
    	return view('admin.room-capacities', compact( 'roomCapacities', 'collection') );
    }
    public function json(){
    	return RoomCapacity::all();
    }
    public function create(){

    	$data = request()->validate([
    		'name' => ['required', 'string'],
    		'description' => ['required', 'string'],
    	]);
    	//dd($data);
    	$capacity  = RoomCapacity::create($data);
    	Session::flash('status', "{$capacity->name} has been added");
    	return redirect('room-capacities');
    }
    public function update(RoomCapacity $capacity){
        $data = request()->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);
        $updated = $capacity->update($data);
        Session::flash('status', "{$capacity->name} has been updated");
        $resp = [
            'success' => $updated,
            'redirect' => "/room-capacities"
        ];
        return $resp;
    }
    public function destroy(RoomCapacity $capacity){
        $deleted = $capacity->delete();
        Session::flash('status', "{$capacity->name} has been deleted");
        $resp = [
            'success' => $deleted,
            'redirect' => "/room-capacities"
        ];
        return $resp;

    }
}
