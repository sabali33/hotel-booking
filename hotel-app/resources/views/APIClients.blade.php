@extends('layouts.app')

@section('content')
<div class="api-clients-list-container">
    <div class="container">
        <h1 class="main-heading">
            API client list
        </h1>
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
    

</div>
@endsection