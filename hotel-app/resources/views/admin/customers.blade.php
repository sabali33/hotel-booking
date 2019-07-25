@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-2">
            <admin-nav isadmin={{Gate::allows('isAdmin', Room::class)}}></admin-nav>
        </div>
        <div class="col-10">
            <div class="justify-content-center">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                

                <div class="rooms-box d-flex justify-content-between mb-5 customers ">
                    <h1 class="heading"> Customers </h1>
                    <a href="/new-customer" class="btn btn-primary"> Add New Customer</a>
                    @foreach( $customers as $customer)
                        <div class="room d-inline-flex py-4 justify-content-around">
                            
                               {{--  <img src="{{ $room->room_image }}" alt="{{ $room->name }}" class="w-25 h-25"> --}}
                            
                            <div class="room-attribute">
                                <strong>Customer Name: </strong><br>{{ $customer->first_name }} {{ $customer->last_name }}
                            </div>
                            
                            <div class="room-attribute">
                                <strong>Address: </strong><br>{{ $customer->address }}
                            </div>
                            <div class="room-attribute">
                                <strong>City: </strong><br>{{ $customer->city }},{{ $customer->country }}
                            </div>
                            <div class="room-attribute">
                                <strong>Booking Count: </strong><br>{{ count($customer->bookings)  }}
                            </div>
                            <div class="action-box">
                                <a href="/customer/{{$customer->id}}" class="btn btn-danger deleteCustomer">Delete</a>
                                <a href="/customer/{{$customer->id}}/edit" class="btn btn-primary ml-2">Edit</a>
                                 {{-- <edit-button roomId="{{ $customer->id }}" key="{{ $customer->id}}"></edit-button>  --}}
                            </div>
                            
                        </div>
                        
                    @endforeach
                    
                </div>
                <div class="pagination-box">
                    
                    {{$customers->links()}}
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection