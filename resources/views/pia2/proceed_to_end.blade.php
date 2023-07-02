@extends('layouts.sidebar_layout')

@section('title', 'Success!')

@section('content')

<p>Your Input has now been Submitted</p>

<a href="{{ url('dashboard') }}" class="btn btn-primary">Proceed to Dashboard</a>

@stop
