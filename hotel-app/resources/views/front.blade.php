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
            <div class="book-form-container">
                <form action="/find-rooms" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="from" class="col-md-4 col-form-label text-md-right">{{ __('From') }}</label>

                        <div class="col-md-6">
                            <input id="from" type="date" class="form-control @error('from') is-invalid @enderror" name="from" value="{{ old('from') ?? today()}}" required autocomplete="from" autofocus placeholder="Today">

                            @error('from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="to" class="col-md-4 col-form-label text-md-right">{{ __('To') }}</label>

                        <div class="col-md-6">
                            <input id="to" type="date" class="form-control @error('to') is-invalid @enderror" name="to" value="{{ old('to') ?? 'Tomorrow'}}" required autocomplete="to" autofocus placeholder="Tomorrow">

                            @error('to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="room-type" class="col-md-4 col-form-label text-md-right">{{ __('from') }}</label>

                        <div class="col-md-6">
                           <!--  <input id="from" type="date" class="form-control @error('from') is-invalid @enderror" name="from" value="{{ old('from') }}" required autocomplete="from" autofocus> -->
                           <select name="room_type" id="room-type" class="orm-control @error('from') is-invalid @enderror">
                               <option value="standard">Standard</option>
                               <option value="deluxe">Deluxe</option>
                               <option value="luxury">Luxury</option>
                           </select>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row offset-4">
                        <button class="btn btn-primary">Book Now</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
