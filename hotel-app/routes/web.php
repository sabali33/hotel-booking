<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');
Route::get('/find-rooms', "FindRoomController@index");
Route::put('/room/upload', 'RoomController@upload');
Route::get('/rooms', 'RoomController@index');
Route::put('/room/{room}/edit', 'RoomController@update');
Route::get('/room/{room}', 'RoomController@destroy');

Route::post('/new-price', 'PriceManagerController@create');
Route::get('/price/{price}', 'PriceManagerController@destroy');
Route::put('/price/{price}/edit', 'PriceManagerController@update');
Route::get('/price/edit/{price}', 'PriceManagerController@show');

Route::post('/new-room', 'RoomController@create');
Route::get('/settings', 'SettingsController@index');
Route::post('/new-room-type', 'RoomTypeController@create');
Route::get('/room-type/{type}', 'RoomTypeController@destroy');

Route::get('/room-types', 'RoomTypeController@index');

Route::post('/new-room-capacity', 'RoomCapacityController@create');
Route::get('/room-capacities', 'RoomCapacityController@index');
Route::put('/room-capacity/{capacity}/edit', 'RoomCapacityController@update');
Route::get('/room-capacity/{capacity}', 'RoomCapacityController@destroy');

Route::get('/bookings', 'BookingController@index');
Route::get('/booking/{booking}', 'BookingController@destroy');
Route::put('/booking/{booking}/edit', 'BookingController@update');
Route::get('/prices', 'PriceManagerController@index');

Route::get('/api/types', 'RoomTypeController@json' );
Route::get('/api/prices', 'PriceManagerController@json' );
Route::get('/api/capacities', 'RoomCapacityController@json' );
Route::get('/api/room/{room}', 'RoomController@json');
Route::get('/api/rooms', 'RoomController@getAll');

Route::post('/new-customer', 'CustomerController@create');
Route::put('/customer/{customer}', 'CustomerController@update')->name('customer.update');
Route::get('/customer/{customer}/edit', 'CustomerController@show')->name('customer.edit');
Route::get('/customers', 'CustomerController@index');
Route::get('/new-customer', 'CustomerController@display');

Route::get('/settings', 'SettingsController@show');
Route::get('/setting/{settings}/edit', 'SettingsController@edit');
Route::put('/setting/{settings}', 'SettingsController@update');

