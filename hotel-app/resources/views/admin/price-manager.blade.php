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

                <div class="rooms-box d-flex justify-content-between my-5 ">
                    <h1 class="heading pt-0"> Price Manager </h1>

                    @foreach($prices as $price)

                        <div class="room d-inline-flex py-4 justify-content-around">
                            @if($price->rooms)
                            <img src="{{ $price->room->room_image ?? ''}}" alt="{{ $price->room->name ?? '' }}" class="w-25 h-25">
                            
                            <div class="room-attribute">
                                <strong>Room Count: </strong><br>{{ $price->rooms->count()}}
                            </div>
                            @endif
                            <div class="room-attribute">
                                <strong>Dynamic Price </strong><br>@formatMoney( ( $price->dynamic_price ?? 0 ))
                            </div>
                            <div class="room-attribute">
                                <strong>Regular Price: </strong><br>@formatMoney(($price->regular_price ?? 0))
                            </div>
                            <div class="room-attribute">
                                <strong>Dynamic expires on: </strong><br>{{ $price->dynamic_price_expire_date  }}
                            </div>
                            <div class="action-box">
                                <button class="btn btn-danger deletePrice" data-priceid="{{$price->id ?? 0}}">Delete</button>
                                <a href="/price/edit/{{ $price->id ?? 0}}" class="btn btn-primary ml-2">Edit</a>
                            </div>
                            
                        </div>
                        
                    @endforeach
                    
                </div>
                <div class="pagination-box">
                    
                    {{$prices->links()}}
                </div>
                <div class="new-capacity-box pt-5 p-3 ">
                 
                <h2>Add New Type</h2>
                <form action="/new-price" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="regular_price" class="col-md-4 col-form-label text-md-right">{{ __('Regular Price') }}</label>

                        <div class="col-md-6">
                            <input id="regular_price" type="number" class="form-control @error('regular_price') is-invalid @enderror" name="regular_price" value="{{ old('regular_price') }}" required autocomplete="regular_price" autofocus>

                            @error('regular_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dynamic_price" class="col-md-4 col-form-label text-md-right">{{ __('Dynamic Price') }}</label>

                        <div class="col-md-6">
                            <input id="dynamic_price" type="number" class="form-control @error('dynamic_price') is-invalid @enderror" name="dynamic_price" value="{{ old('dynamic_price') }}" required autocomplete="dynamic_price">

                            @error('dynamic_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expire_date" class="col-md-4 col-form-label text-md-right">{{ __('Dynamic Price Expire Date') }}</label>

                        <div class="col-md-6">
                            <input id="expire_date" type="date" class="form-control @error('dynamic_price_expire_date') is-invalid @enderror" name="dynamic_price_expire_date" value="{{ old('dynamic_price_expire_date') }}" required autocomplete="dynamic_price_expire_date" >

                            @error('dynamic_price_expire_date')
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