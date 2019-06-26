@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-2">
            <nav class="navigation py-5">
                
                <ul class="nav-list list-group list-unstyled ">
                    <li class="nav-item list-group-item">
                        <a href="/settings">Hotel Details</a>
                        
                    </li>
                    <li class="nav-item list-group-item">
                        <a href="/rooms">Rooms</a>
                        
                    </li>
                    <li class="nav-item list-group-item">
                        <a href="/room-types">Room Types</a>
                        
                    </li>
                    <li class="nav-item list-group-item">
                        <a href="/bookings">Bookings</a>
                        
                    </li>
                    <li class="nav-item list-group-item">
                        <a href="/prices">Room Prices</a>
                        
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-10">
            <div class="justify-content-center">
                
                <div class="new-button py-5">
                    
                    <new-room-button></new-room-button> 
                </div>  
                <div class="filter-box">
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

                <div class="rooms-box d-flex justify-content-between my-5 ">
                    @foreach( $rooms as $room)
                        <div class="room d-inline-flex py-4 justify-content-around">
                            
                                <img src="{{ $room->room_image }}" alt="{{ $room->name }}" class="w-25 h-25">
                            
                            <div class="room-attribute">
                                <strong>Room Name: </strong><br>{{ $room->name }}
                            </div>
                            
                            <div class="room-attribute">
                                <strong>Type: </strong><br>{{ $room->roomType->name }}
                            </div>
                            <div class="room-attribute">
                                <strong>Price: </strong><br>{{ $room->price->regular_price ?? 0 }}
                            </div>
                            <div class="room-attribute">
                                <strong>Booking Count: </strong><br>{{ count($room->books)  }}
                            </div>
                            <div class="action-box">
                                <button class="btn btn-danger">Delete</button>
                                <button class="btn btn-primary">Edit</button>
                            </div>
                            
                        </div>
                        
                    @endforeach
                    
                </div>
                <div class="pagination-box">
                    
                    {{$rooms->links()}}
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection