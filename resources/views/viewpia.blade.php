@extends('layouts.sidebar_layout')

@section('title', 'Privacy Impact Assessment List')

@section('content')
<div class="container"> 
    <div class="row justify-content-center">
        <div class="container text-center">
            <img src="img/USEP_Logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <h2 class="text-center">University of Southeastern Philippines</h2>
            <h2 class="text-center">PRIVACY IMPACT ASSESSMENT</h2>
        </div>
    </div>

    @if($Process)
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Process Information</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Process Name:</strong></td>
                                <td>{{ $Process->ProcessName }}</td>
                            </tr>
                            <tr>
                                <td><strong>Data Subject:</strong></td>
                                <td>{{ $Process->DataSubject }}</td>
                            </tr>
                            <tr>
                                <td><strong>Data Fields:</strong></td>
                                <td>
                                    <ul>
                                        @if(isset($DataFields))
                                        @foreach ($DataFields as $item)
                                        @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                                        <li>{{ $item->FormUsed }}</li>
                                        <ul>
                                            @foreach ($item->Datacollected as $collected)
                                                <li>{{ $collected }}</li>
                                            @endforeach
                                        </ul>   
                                        @endif
                                        @endforeach
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Purpose for Processing:</strong></td>
                                <td>{{ $Process->PurposeforProcessing }}</td>
                            </tr>
                            <tr>
                                <td><strong>Security Measure:</strong></td>
                                <td>{{ $Process->SecurityMeasure }}</td>
                            </tr>
                            <tr>
                                <td><strong>Process Narrative:</strong></td>
                                <td>{{ $Process->ProcessNarrative }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($RiskManagement)
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Risk Management</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Threat/Vulnerability</th>
                                <th>Impact</th>
                                <th>Probability</th>
                                <th>Risk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($RiskManagement as $item)
                            @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                            <tr>
                                <td>{{ $item->ThreatsVulnerabilities }}</td>
                                <td>{{ $item->Impact }}</td>
                                <td>{{ $item->Probability }}</td>
                                <td>{{ $item->RiskRating }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($DataFlow)
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Flow</h5><br>
                    <div class="row">
                        @foreach ($DataFlow as $item)
                        @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8 mb-4">
                                    <div class="card">
                                        <img src="/images/{{ $item->FileName }}" alt="{{ $item->FileName }}" class="card-img-top img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
