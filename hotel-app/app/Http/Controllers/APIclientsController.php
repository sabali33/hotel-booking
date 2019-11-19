<?php

namespace App\Http\Controllers;

use App\APIclients;
use Illuminate\Http\Request;

class APIclientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = APIclients::all();
        return view('APIClients', compact($clients));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\APIclients  $aPIclients
     * @return \Illuminate\Http\Response
     */
    public function show(APIclients $aPIclients)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\APIclients  $aPIclients
     * @return \Illuminate\Http\Response
     */
    public function edit(APIclients $aPIclients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\APIclients  $aPIclients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, APIclients $aPIclients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\APIclients  $aPIclients
     * @return \Illuminate\Http\Response
     */
    public function destroy(APIclients $aPIclients)
    {
        //
    }
}
