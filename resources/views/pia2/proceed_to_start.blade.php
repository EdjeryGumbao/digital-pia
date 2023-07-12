@extends('layouts.sidebar_layout')

@section('title', '')

@section('content')

<div class="h-100 d-flex align-items-center justify-content-center">
    <div class="login-box">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><strong>Enter the process name of this Privacy Impact Assessment</strong></p>
            <form action="InsertPrivacyImpactAssessment" method="post">
                @csrf
                <input type="text" class="form-control" name="ProcessName" value="{{ $PrivacyImpactAssessment->ProcessName ?? ''}}"><br>
                <button type="submit" class="btn btn-primary btn-block">Next</button>
            </form>
        </div>
        @foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach
    </div>
</div>
<p class="text-center">PIA Version {{ session('PrivacyImpactAssessmentVersion') }}</p>

@stop