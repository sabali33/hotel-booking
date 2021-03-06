@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-2">
            <admin-nav isadmin="{{ Gate::allows('isAdmin', Room::class) }}"> </admin-nav>
        </div>
        <div class="col-10">
            <div class="justify-content-center">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                  
                <div class="filter-box pt-5">
                    <span>Filter Rooms: </span>
                    <div class="filters d-flex">
                        <select name="roomType" class="filter-by-rt">
                            <option value=""> Sort By Type</option>
                        @foreach( $roomTypes as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            
                        @endforeach
                        
                    </select>
                    </div>
                    
                </div>
                <div class="calendar-view-box">
                    
                    <bookings-calendar-view bookeddays="{{$allBookedDays}}"></bookings-calendar-view>
                </div>
                <div class="rooms-box d-flex justify-content-between my-5 bookings">
                    <h1 class="heading"> Rooms Bookings </h1>
                    @foreach( $bookings as $booking)

                        <div class="room d-inline-flex py-4 justify-content-around ">
                            
                            @if(str_contains($booking->room->room_image, 'http'))
                                <img src="{{ $booking->room->room_image ?? 'No name' }}" alt="{{ $booking->room->name ?? 'No name' }}" class="w-25 h-25">
                            @else
                                <img src="/storage/images/{{ $booking->room->room_image ?? '' }}" alt="{{ $booking->room->name ?? 'No name'}}" class="w-25 h-25">
                            @endif
                            
                            <div class="room-attribute mb-3">
                                <strong>Room Name: </strong><br>{{ $booking->room->name ?? 'No names' }}
                            </div>
                            
                            <div class="room-attribute mb-3">
                                <strong>Start: </strong><br>{{ $booking->start_date }}
                            </div>
                            <div class="room-attribute mb-3">
                                <strong>End: </strong><br>{{ $booking->end_date ?? 0 }}
                            </div>
                            <div class="room-attribute mb-3">
                                <strong>Customer: </strong><br>{{ $booking->customer->first_name  }}
                            </div>
                            <div class="action-box">
                                <button class="btn btn-danger delete-booking" data-bookingid="{{$booking->id}}">Delete</button>
                                {{-- <button class="btn btn-primary">Edit</button> --}}
                                <edit-booking booking="{{$booking}}"></edit-booking>
                            </div>
                            
                        </div>
                        
                    @endforeach
                    @if($bookings->count() < 1)
                        <div class="no-bookings my-4">
                            <i class="nothing">Sorry, you do not have bookings yet</i>
                        </div>
                    @endif
                    
                </div>
                <div class="pagination-box">
                    
                    {{ (!is_array($bookings)) ? $bookings->links() : ''}}
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection