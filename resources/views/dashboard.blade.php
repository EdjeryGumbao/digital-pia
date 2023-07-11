@extends('layouts.sidebar_layout')

@section('title', 'Dashboard')

@section('content')
    
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="img/USEP_Logo.png" alt="AdminLTELogo" height="200" width="200">
    </div>

    <p>Welcome to the Dashboard!</p>

    @if (auth()->user()->usertype == 'user')
        <a href="{{ url('/proceed_to_disclaimer') }}" class="btn btn-primary">Start Privacy Impact Assessment</a>
    @elseif (auth()->user()->usertype == 'admin')
        <a href="{{ url('/pialist') }}" class="btn btn-primary">Click here to view all the PIA</a>
    @endif
@stop