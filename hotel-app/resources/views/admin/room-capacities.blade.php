@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-2">
            <admin-nav></admin-nav>
        </div>
        <div class="col-10">
            <div class="justify-content-center capability">
               
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                 
                {{-- <div class="filter-box">
                    <span>Filter Rooms: </span>
                    <div class="filters d-flex">
                        <select name="roomType" class="filter-by-rt">
                            <option value=""> Sort By Type</option>
                        @foreach( $roomCapacities as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            
                        @endforeach
                        
                    </select>
                    </div>
                    
                </div> --}}

                <div class="rooms-box d-flex justify-content-between my-5 ">
                    <h1 class="heading"> Room Capacities</h1>
                    @foreach( $roomCapacities as $roomCapacity)
                        <div class="room d-inline-flex py-4 justify-content-start">
                            
                            <div class="room-attribute">
                                <strong class="mb-2">Name: </strong><br>{{ $roomCapacity->name }}
                            </div>
                            
                            <div class="room-attribute">
                                <strong class="mb-2">Description: </strong><br>{{ $roomCapacity->description }}
                            </div>
                            
                            <div class="action-box">
                                {{-- <button class="btn btn-danger">Delete</button>
                                <button class="btn btn-primary">Edit</button> --}}
                                <new-attribute capacity="{{$roomCapacity}}"></new-attribute>
                            </div>
                            
                        </div>
                        
                    @endforeach
                    
                </div>
                <div class="pagination-box">
                    
                    {{$roomCapacities->links()}}
                </div>
            </div>
            <div class="new-capacity-box pt-5 p-3 ">
                 
                <h2>Add New Capacity</h2>
                <form action="/new-room-capacity" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-8 offset-2">
                             <button class="btn btn-primary">Add New Capacity</button>
                        </div>
                       
                    </div>
                </form>
            </div> 
           
        </div>
        
    </div>

</div>
@endsection