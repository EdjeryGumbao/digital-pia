@extends('layouts.sidebar_layout')

@section('title', '')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <p>
                    <strong>Disclaimer:</strong> A Privacy Impact Assessment (PIA) is an instrument for assessing the potential impacts on privacy of a process, 
                    information system, program, software module, device or other initiative which processes personal information and in 
                    consultation with stakeholders, for taking actions as necessary to treat privacy risk.
                </p>
                <br>
                <p>
                    A PIA is more than a tool: its process that begins at the earliest possible stages of an initiative when there are still 
                    opportunities to influence its outcome and thereby ensure privacy by design. It is a process that continues until, and 
                    even after, the project has been deployed. Initiatives vary substantially in scale and impact.
                </p>
                <br>
                <p>
                    This website will help you create a PIA following a step-by-step instructional process that will result in a PIA report 
                    may include documentation about measures taken for risk treatment to be monitored and reviewed by the DPO (Data Protection 
                        Officer).
                </p>
                <a href="{{ url('/proceed_to_start') }}" class="btn btn-primary">Start</a>
            </div>
        </div>
    </div>
</div>

@stop