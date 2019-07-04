@extends('layouts.app')

@section('content')
<div class="container">
    <div class="main">
        <header class="header">
            <div class="logo">
                <a href="?">OnTime Hotel</a>
            </div>
        </header>
        <main class="main">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="book-form-container">
                <h1 class="heading">Edit Settings</h1>
                <form action="/setting/1" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                   <div class="form-group row">
                        <label for="room-image" class="col-4 col-form-label text-md-right" >Room Image</label>
                        <div class="col-md-6">
                        
                            <input type="file" class="form-control-file" id="room-image" name="image" value="{{$settings->image}}" >
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label for="hotel_name" class="col-md-4 col-form-label text-md-right">{{ __('Hotel Name') }}</label>

                        <div class="col-md-6">
                            <input id="hotel_name" type="text" class="form-control @error('hotel_name') is-invalid @enderror" name="name" value="{{ old('hotel_name') ?? $settings->name}}" required autocomplete="hotel_name" autofocus>

                            @error('hotel_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $settings->address}}" required autocomplete="address">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $settings->email}}" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                        <div class="col-md-6">
                            <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') ?? $settings->state }}"  autocomplete="state" >

                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                        <div class="col-md-6">
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') ?? $settings->city }}" required autocomplete="city">

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" id="country" name="country">
                                <<option value="0">Choose Country</option>}
                                option
                                @foreach($countries as $country)
                                <option value="{{$country->name}}" @if( $country->name == $settings->country) selected @endif>{{$country->name}}</option>
                                @endforeach
                                
                            </select>

                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-8 offset-2">
                             <button class="btn btn-primary updateCustomer">Update</button>
                        </div>
                       
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
