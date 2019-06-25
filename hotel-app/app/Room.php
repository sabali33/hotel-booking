<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
class Room extends Model
{
    public function price(){
    	return $this->hasOne(PriceManager::class);
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
            //var_dump($booking->end_date);
            return $this->getBookedDays( $booking->start_date, $booking->end_date );
        });
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    protected function getBookedDays($in, $out){
        if(!$in || !$out){
            return false;
        }
        $inDate = new DateTime($in);
        $inDay = $inDate->format('d');
        $outDate = new DateTime($out);
        $outDay = $outDate->format('d');
        $bookedDays = [$inDate->format('Y-m-d')];

        foreach( range($inDay, ($outDay - 1)) as $key => $d){
            
            $currentDate = $inDate->modify( '+1 day' );
            
            $bookedDays[] = $currentDate->format('Y-m-d');
        }
        
        return $bookedDays;

    }
    public function isBooked($inDate){
        $days = $this->bookedOn()->toArray();
        $all_days = [];
        foreach( $days as $daysBooked){
            foreach( $daysBooked as $day){
                $all_days[] = $day;
            }
        }
        return in_array($inDate, $all_days);

    }
}
