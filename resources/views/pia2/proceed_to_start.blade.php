@extends('layouts.sidebar_layout')

@section('title', '')

@section('content')

@if(isset($PrivacyImpactAssessment))
    @php
        $Name = $PrivacyImpactAssessment->Name;
    @endphp
@else
    @php
        $Name = '';
    @endphp
@endif


<div class="h-100 d-flex align-items-center justify-content-center">
    <div class="login-box">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Enter the title of this Privacy Impact Assessment</p>
            <form action="InsertPrivacyImpactAssessment" method="post">
                @csrf
                <input type="text" class="form-control" name="Name" value="{{ $Name }}"><br>
                <button type="submit" class="btn btn-primary btn-block">Next</button>
            </form>
        </div>
        @foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach
    </div>
</div>
<p class="text-center">PIA Version {{ session('PrivacyImpactAssessmentVersionID') }}</p>

@stop