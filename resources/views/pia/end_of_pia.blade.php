@extends('layouts.sidebar_layout')

@section('title', 'Success!')

@section('content')

@if($value == 1)
    <p>Your Input has now been Submitted</p>

    <a href="{{ url('dashboard') }}" class="btn btn-primary">Proceed to Dashboard</a>

@else
    <p>You can't submit with incomplete inputs.</p>
    <a href="{{ url('system_description') }}" class="btn btn-primary">Start Again</a>
@endif

@stop
