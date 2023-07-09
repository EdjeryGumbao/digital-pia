@extends('layouts.sidebar_layout')

@section('title', 'Dashboard')

@section('content')
    <p>Welcome to the Dashboard!</p>

    @if (auth()->user()->usertype == 'user')
        <a href="{{ url('/proceed_to_start') }}" class="btn btn-primary">Start Privacy Impact Assessment</a>
    @elseif (auth()->user()->usertype == 'admin')
        <a href="{{ url('/pialist') }}" class="btn btn-primary">Click here to view all the PIA</a>
    @endif
@stop