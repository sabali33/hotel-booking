<?php

namespace App\Http\Controllers;
use App\PriceManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PriceManagerController extends Controller
{
    //
    public function index(){
    	
    	$prices = PriceManager::paginate(5);
        //dd($prices);
    	return view('admin.price-manager', compact('prices') );
    }
    public function json(){
    	return PriceManager::all();
    }
    public function create(){
    	$data = request()->validate([
    		'regular_price' => ['float', 'required'],
    		'dynamic_price' => ['float'],
    		'dynamic_price_expire_date' => ['string']
    	]);
    	$price = PriceManager::create($data);
    	Session::flash('status', "{$price->regular_price} has been added");

    	return redirect('/prices');

    }
    public function destroy(PriceManager $price){
    	$deleted = $price->delete();
    	Session::flash('status', "{$price->dynamic_price} as been deleted");
    	return [
    		'success' => $deleted,
    		'redirect' => '/prices'
    	];
    }
    public function update(PriceManager $price){
    	$data = request()->validate([
    		'regular_price' => ['required', 'numeric'],
    		'dynamic_price' => ['numeric'],
    		'dynamic_price_expire_date' => ['string']
    	]);
    	$updated = $price->update($data);
    	if($updated){
    		Session::flash('status', "{$price->regular_price} has been updated!");
    	}
    	return redirect('/prices');
    }
    public function show(PriceManager $price){
    	return view('admin.price', compact('price'));
    }
}
