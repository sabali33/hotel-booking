@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-2">
            <admin-nav isadmin={{Gate::allows('isAdmin', Room::class)}}></admin-nav>
        </div>
        <div class="col-10">
            <div class="justify-content-center ml-4">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="hotel-details w-75 d-flex justify-content-start position-relative">
                    <h1 class="heading">Hotel details</h1>
                    <div class="attribute-item d-flex">
                        <span class="label w-50">Hotel Image</span>
                        <img src="/storage/{{$settings->image}}" alt="Hotel name" class="w-50 h-50">

                    </div>
                    <div class="attribute-item d-flex">
                        <span class="label w-50"> Name</span>
                        <span class="flex-grow-1">{{ $settings->name }}</span>

                    </div>
                    <div class="attribute-item d-flex">
                        <span class="label w-50"> Address</span>
                        <span class="flex-grow-1">{{ $settings->address }}</span>

                    </div>
                    <div class="attribute-item d-flex">
                        <span class="label w-50"> City</span>
                        <span class="flex-grow-1">{{ $settings->city }}</span>

                    </div>
                    <div class="attribute-item d-flex">
                        <span class="label w-50"> Phone</span>
                        <span class="flex-grow-1">{{ $settings->phone }}</span>

                    </div>
                    <div class="attribute-item d-flex">
                        <span class="label w-50"> Country</span>
                        <span class="flex-grow-1">{{ $settings->country }}</span>

                    </div>
                    <span class="edit-setting position-absolute ">
                        <a href="/setting/1/edit" class="btn btn-primary edit-setting-link">Edit</a>
                    </span>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection