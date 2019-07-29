<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Customer;
use App\User;
class CustomerController extends Controller
{
    public function index(){
    	
    	$customers = Customer::paginate(5);
    
    	return view('admin.customers', compact('customers') );
    }
    public function show(Customer $customer){
    	$countries = collect($this->getCountries());
    	
    	return view('admin.single.customer', compact('customer', 'countries'));
    }
    public static function getCountries(){
    	
    	$ch = curl_init("https://restcountries.eu/rest/v2/all"); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);

    	return json_decode( $data );
    }
    public function update(Customer $customer){

    	$data = Validator::make(request()->all(), $this->getValidator())->validate();
    	
    	$updated = $customer->update($data);
    	
    	if($updated){
    		Session::flash('status', "{$customer->first_name} has been updated!");
    	}
    	return redirect('/customers');
    }
    public function getValidator(){
    	return array(
    		'first_name' => ['required', 'string'],
    		'last_name' => ['required', 'string'],
    		'address' => ['required', 'string'],
    		'city' => ['required', 'string'],
    		'email' => ['required', 'email'],
    		'country' => ['required', 'string']
    	);
    }
    public function display(){
        $countries = collect($this->getCountries());
        return view('admin.single.customer-new', compact('countries'));
    }
    public function create(){
        $data = request()->validate($this->getValidator());
        $data['password'] = str_pad($data['first_name'], 8, "#@", STR_PAD_LEFT);
        $data['name'] = $data['first_name'].' '.$data['last_name'];
        try{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
        }catch(\Exception $e){
            Session::flash('status', 'couldn\'t add this user');
            return redirect('/new-customer');
        }
        
        
        $customer = $user->customer()->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            
        ]);
        
        if($customer){
            //email user a password
            
            Session::flash('status', "Customer {$user->name} has been created!");
            return redirect('/customers');
        }
        
    }
    public static function createUserCustomer($data){
        if(!$data){
            return null;
        }
        try{
            
        }catch(\Exception $e){
            Session::flash('status', 'couldn\'t add this user');
            return redirect('/new-customer');
        }
        
        //return $customer;

    }
    public function profile(){

        //$this->authorize( 'editProfile', $customer);
        $customer = auth()->user();
        return view('admin.profile', compact('customer'));
    }
}
