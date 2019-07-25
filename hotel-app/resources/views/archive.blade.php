@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-4">
        <div class="col-md-8">
            
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="archive d-flex">
                
                <div class="selected-dates d-flex justify-content-between mb-4 p-3">
                    <span class="sep">From</span>
                    <span class="from">{{$dates['in']->format('Y-m-d')}}</span>
                    <span class="sep">to</span>
                    <span class="to">{{$dates['out']->format('Y-m-d')}}</span>
                </div>
               
                @foreach( $rooms as $room)
                    
                    <div class="listing d-flex justify-content-between">
                    
                        @if(str_contains($room->room_image, 'http'))
                            <img src="{{ $room->room_image }}" alt="{{ $room->name }}" class="w-25 h-25">
                        @else
                            <img src="/storage/images/{{ $room->room_image }}" alt="{{ $room->name }}" class="w-25 h-25">
                        @endif
                        <div class="content ml-4">
                            <div class="name my-2">
                                <h2 class="label">Room {{$room->name}} </h2>
                                
                            </div>
                            <div class="type my-2">
                                <span class="label">Type: {{$room->roomType->name}}</span>
                                
                                <p class="name">{{$room->roomType->description}}</p>
                            </div>
                            <div class="capacity my-2">
                                <span class="label">Capacity: {{$room->roomCapacity->name}}</span>
                                
                                <p class="name">{{$room->roomCapacity->description}}</p>
                            </div>
                        </div>
                        <div class="button-box w-50 ml-4 align-self-center">
                            <span class="price">
                                <strong> @formatMoney(($room->price->regular_price ?? 0))</strong>
                                                            </span>
                            <booking-form room="{{$room}}" dates="{{$dates}}" json="false"></booking-form>
                        </div> 
                    </div>
                @endforeach
                @if(!$rooms->count())
                    <div class="no-rooms text-center p-5" >
                        Sorry, no rooms found for the specified filters
                    </div>
                @endif
            </div>
            

            
            
                
            
            
        
    </div>
</div>
@endsection
