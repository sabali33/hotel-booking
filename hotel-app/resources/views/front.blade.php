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
            <div class="find-room-container">
                <h1>Find a room</h1>
                <form action="/find-rooms" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-6 offset-4">
                            <div class="wrap">
                               
                                <home-calendar roomtypes="{{$roomTypes}}"></home-calendar>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    
                </form>
                
            </div>
        </main>

    </div>
</div>
@endsection
