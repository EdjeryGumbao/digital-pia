@extends('layouts.sidebar_layout')

@section('title', 'Dashboard')

@section('content')
    <p>Welcome to the Dashboard!</p>

    <a href="{{ url('/proceed_to_start') }}" class="btn btn-primary">Start Privacy Impact Assessment</a>
    {{ session('')}}

@stop