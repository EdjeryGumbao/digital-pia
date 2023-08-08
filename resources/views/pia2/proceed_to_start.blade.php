@extends('layouts.sidebar_layout')

@section('title', 'Start')

@section('content')

<div class="h-100 d-flex align-items-center justify-content-center">
    <div class="login-box">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><strong>Enter the process name of this Privacy Impact Assessment</strong></p>
            <form action="InsertPrivacyImpactAssessment" method="post">
                @csrf
                <label for="Department">Department</label>
                <select name="ProcessName" class="form-control">
                    <option value="{{ $PrivacyImpactAssessment->ProcessName ?? 'None Selected'}}"> {{ $PrivacyImpactAssessment->ProcessName ?? 'None Selected'}} </option>
                    <option value="Guidance and Counseling Service">Guidance and Counseling Service</option>
                    <option value="Group Guidance Sessions">Group Guidance Sessions</option>
                    <option value="Seminars/Workshops/Symposia">Seminars/Workshops/Symposia</option>
                    <option value="Telecounseling Services">Telecounseling Services</option>
                    <option value="Testing Services">Testing Services</option>
                    <option value="Student Peer Facilitator (SPF) Membership">Student Peer Facilitator (SPF) Membership</option>
                </select>
                <br>
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