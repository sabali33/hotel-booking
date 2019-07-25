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
                {{$roomTypes}}
               {{--  <div class="new-button py-5">
                    
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
                    
                </div> --}}

                <div class="rooms-box d-flex justify-content-around my-5 ">
                    <h1 class="heading"> Rooms Types </h1>
                    @foreach( $roomTypes as $roomType)
                        <div class="room d-inline-flex py-4 justify-content-start">
                            
                            <div class="room-attribute">
                                <strong>Name: </strong><br>{{ $roomType->name }}
                            </div>
                            
                            <div class="room-attribute">
                                <strong>Description: </strong><br>{{ $roomType->description }}
                            </div>
                            
                            <div class="action-box">
                                <button class="btn btn-danger delete-attribute" data-attributeid="{{$roomType->id}}">Delete</button>
                                <button class="btn btn-primary ml-2">Edit</button>
                            </div>
                            
                        </div>
                        
                    @endforeach
                    
                </div>
                <div class="pagination-box">
                    
                    {{$roomTypes->links()}}
                </div>
                <div class="new-capacity-box pt-5 p-3 ">
                 
                    <h2>Add New Type</h2>
                    <form action="/new-room-type" method="POST">
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
                                 <button class="btn btn-primary">Add New Type</button>
                            </div>
                           
                        </div>
                    </form>
                </div
            </div>
        </div>
        
    </div>
</div>
@endsection