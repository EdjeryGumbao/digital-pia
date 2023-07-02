@extends('layouts.sidebar_layout')

@section('title', '')

@section('content')
<div class="h-100 d-flex align-items-center justify-content-center">
    <div class="login-box">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Enter the title of this Privacy Impact Assessment</p>
            <form action="proceed_to_process" method="post">
                @csrf
                <input type="text" class="form-control" name="Name"><br>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
@stop