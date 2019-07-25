<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
class Room extends Model
{
    protected $guarded = [];
    public function price(){
    	return $this->belongsTo(PriceManager::class, 'price_manager_id');
    }
    public function roomType(){
    	return $this->belongsTo(RoomType::class);
    }
    public function roomCapacity(){
    	return $this->belongsTo(RoomCapacity::class);
    }
    public function bookedOn(){
        if( !$this->bookings->count() ){
            return null;
        }
    	return $this->bookings->map(function($booking){
            
            return $this->getBookedDays( $booking->start_date, $booking->end_date );
        });
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    public function getBookedDays(){
        return method_exists($this->bookings, 'getBookedDays') ? $this->bookings->getBookedDays() : [];

    }
    public function isBooked($inDate){

        $available = $this->bookings->filter( function($booking) use($inDate){
            
            return $booking->getBookedDays()->contains($inDate);
        });
        return $available->isNotEmpty();

    }
    public function getLastBookedDate(){
        $days = $this->bookedOn()->toArray();
        $lastBookings = array_pop($days);
        return array_pop($lastBookings);
    }
}
