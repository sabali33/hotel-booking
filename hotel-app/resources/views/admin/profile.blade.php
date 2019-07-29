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

            <div class="user-profile">
                
                Welcome to your profile
            </div>
        </main>
    </div>
</div>
@endsection
