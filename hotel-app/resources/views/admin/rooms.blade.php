@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        
        <div class="col-2">
            <admin-nav isadmin={{Gate::allows('isAdmin', Room::class)}} ></admin-nav>
        </div>
        <div class="col-10">
            <div class="justify-content-center">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @can('create', App\User::class)

                <div class="new-button py-5">
                    
                    <new-room-button></new-room-button> 
                </div> 
                @endcan 

                <div class="filter-box d-flex">
                    <span class="mr-3">Filter Rooms: </span>
                    <div class="filters">
                        <select name="roomType" class="filter-by-rt">
                            <option value=""> Sort By Type</option>
                        @foreach( $roomTypes as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            
                        @endforeach
                        
                    </select>
                    </div>
                    
                </div>

                <div class="rooms-box d-flex justify-content-between mb-5 ">
                    <h1 class="heading"> Rooms </h1>
                    {{$rooms}}
                    @foreach( $rooms as $room)

                        <div class="room d-inline-flex py-4 justify-content-around">
                            @if(str_contains($room->room_image, 'http'))
                                <img src="{{ $room->room_image }}" alt="{{ $room->name }}" class="w-25 h-25">
                            @else
                                <img src="/storage/images/{{ $room->room_image }}" alt="{{ $room->name }}" class="w-25 h-25">
                            @endif
                            <div class="room-attribute">
                                <strong>Room Name: </strong><br>{{ $room->name }}
                            </div>
                            
                            <div class="room-attribute">
                                <strong>Type: </strong><br>{{ $room->roomType->name }}
                            </div>
                            <div class="room-attribute">
                                <strong>Price: </strong><br>@formatMoney(($room->price->regular_price ?? 0))
                            </div>
                            <div class="room-attribute">
                                <strong>Booking Count: </strong><br>{{ count($room->bookings)  }}
                            </div>
                            @can('update', $room)
                                <div class="action-box">
                                    <a href="/room/{{$room->id}}" class="btn btn-danger">Delete</a>
                                    
                                        <edit-button roomId="{{ $room }}" key="{{ $room->id}}"></edit-button> 
                                    
                                </div>
                            @endcan
                            
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