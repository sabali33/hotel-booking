<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FindRoomController extends Controller
{
    public function index(){
    	dd(request()->all());
    }
}
