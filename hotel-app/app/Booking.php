<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use DateTime;
class Booking extends Model
{
    public function room(){
    	return $this->belongsTo(Room::class);
    }
    public function customer(){
    	return $this->belongsTo(Customer::class);
    }
    public function getBookedDays(){
        
        $inDate = new DateTime($this->start_date);
        $inDay = $inDate->format('d');
        $outDate = new DateTime($this->end_date);
        $outDay = $outDate->format('d');
        $bookedDays = [$inDate->format('Y-m-d')];

        foreach( range($inDay, ($outDay - 1)) as $key => $d){
            
            $currentDate = $inDate->modify( '+1 day' );
            
            $bookedDays[] = $currentDate->format('Y-m-d');
        }
        
        return collect($bookedDays);

    }
    public function isBooked($inDate){
        $days = $this->getBookedDays();
        if(!$days){
            return null;
        }
        $all_days = [];
        foreach( $days as $daysBooked){
            foreach( $daysBooked as $day){
                $all_days[] = $day;
            }
        }
        return in_array($inDate, $all_days);

    }
    
}
