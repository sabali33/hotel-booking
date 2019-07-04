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
                <form action="/price/{{$price->id}}/edit" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="regular_price" class="col-md-4 col-form-label text-md-right">{{ __('Regular Price') }}</label>

                        <div class="col-md-6">
                            <input id="regular_price" type="text" class="form-control @error('regular_price') is-invalid @enderror" name="regular_price" value="{{ old('regular_price') ?? $price->regular_price}}" required autocomplete="regular_price" autofocus>

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
                            <input id="dynamic_price" type="text" class="form-control @error('dynamic_price') is-invalid @enderror" name="dynamic_price" value="{{ old('dynamic_price') ?? $price->dynamic_price}}" autocomplete="dynamic_price">

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
                            <input id="expire_date" type="date" class="form-control @error('dynamic_price_expire_date') is-invalid @enderror" name="dynamic_price_expire_date" value="{{ old('dynamic_price_expire_date') ?? $price->dynamic_price_expire_date}}"  autocomplete="dynamic_price_expire_date" >

                            @error('dynamic_price_expire_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-8 offset-2">
                             <button class="btn btn-primary">Update</button>
                        </div>
                       
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
