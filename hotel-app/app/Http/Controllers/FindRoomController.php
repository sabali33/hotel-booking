<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
class FindRoomController extends Controller
{
    public function index(){
    	//dd(request()->all());
    	$room = new Room();
    	dd($room->find(3)->bookedOn);
    }
}
