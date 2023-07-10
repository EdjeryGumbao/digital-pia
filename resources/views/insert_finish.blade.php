@extends('layouts.sidebar_layout')

@section('title', 'Success!')

@section('content')
    
<p>Your Input has now been Submitted</p>

<a href="{{ url('/manage') }}" class="btn btn-primary">Finish</a>

@stop