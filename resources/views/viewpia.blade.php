@extends('layouts.sidebar_layout')

@section('title', $PrivacyImpactAssessment->ProcessName ?? '' )

@section('content')

<div class="container"> 
    <div class="row justify-content-center">
        <div class="container text-center">
            <img src="{{ asset('img/USEP_Logo.png') }}" class="brand-image img-circle elevation-3" style="opacity: .8"><br><br>
            <h2 class="text-center">University of Southeastern Philippines</h2>
            <h2 class="text-center">PRIVACY IMPACT ASSESSMENT</h2><br><br>
            <h3 class="text-center">{{ $PrivacyImpactAssessment->Department ?? ''}}</h3>
            <h3 class="text-center">{{ $PrivacyImpactAssessment->Author ?? ''}}</h3>
        </div>
    </div>

    @if($Process)
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Process Information</strong></h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="text-nowrap" width="200px"><strong>Process Name:</strong></td>
                                <td>{{ $PrivacyImpactAssessment->ProcessName ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Data Subject:</strong></td>
                                <td>{{ $Process->DataSubject }}</td>
                            </tr>
                            <tr>
                                <td><strong>Data Fields:</strong></td>
                                <td>
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
                                <td>
                                    <ol style="padding-left: 0;">
                                    @if (isset($Process->ProcessNarrative))
                                        @foreach ($Process->ProcessNarrative as $item) 
                                            <li style="margin-left: 14px;  ">{{ $item }}</li>
                                        @endforeach
                                    @endif
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <th colspan='2' class="text-center">{{ $ProcessQuestions->QuestionSetName ?? '[QuestionSetName Missing/Deleted]' }}</th>
                            </tr>
                            <tr>
                                @if(isset($Process->SectionA))
                                    <td><strong>{{ $ProcessQuestions->SectionATitle ?? '[SectionATitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @foreach($Process->SectionA as $item)
                                            <li> {{ $item }} </li>
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if(isset($Process->SectionB))
                                    <td><strong>{{ $ProcessQuestions->SectionBTitle ?? '[SectionBTitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @foreach($Process->SectionB as $item)
                                            <li> {{ $item }} </li>
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if(isset($Process->SectionC))
                                    <td><strong>{{ $ProcessQuestions->SectionCTitle ?? '[SectionCTitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @foreach($Process->SectionC as $item)
                                            <li> {{ $item }} </li>
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if(isset($Process->SectionD))
                                    <td><strong>{{ $ProcessQuestions->SectionDTitle ?? '[SectionDTitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @foreach($Process->SectionD as $item)
                                            <li> {{ $item }} </li>
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($RiskAssessment)
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Risk Management</strong></h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Threat/Vulnerability</th>
                                <th>Impact</th>
                                <th>Probability</th>
                                <th>Risk Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($RiskAssessment as $item)
                            @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                            <tr>
                                <td>{{ $item->ThreatsVulnerabilities }}</td>
                                <td class="text-center">{{ $item->Impact }}</td>
                                <td class="text-center">{{ $item->Probability }}</td>
                                <td class="text-center" style="background-color: 
                                    @if($item->RiskRating == 1) #fafdff /* white */
                                    @elseif($item->RiskRating >= 2 && $item->RiskRating <= 5) #ffffcc /* light yellow */
                                    @elseif($item->RiskRating >= 6 && $item->RiskRating <= 8) #ffff99 /* yellow */
                                    @elseif($item->RiskRating == 9) #ffcccc /* lighter red */
                                    @elseif($item->RiskRating >= 10 && $item->RiskRating <= 15) #ff9999 /* light red */
                                    @elseif($item->RiskRating >= 16) #ff0000 /* red */
                                    @endif">
                                    {{ $item->RiskRating }}
                                </td>
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
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Data Flow</strong></h5><br>
                    <div class="row">
                        @foreach ($DataFlow as $item)
                            @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 mb-4">
                                        <div class="card">
                                            <a href="/images/{{ $item->FileName }}" target="_blank"> 
                                                <img src="{{ asset('images/'. $item->FileName) }}"   alt="{{ $item->FileName }}" class="card-img-top img-fluid">
                                            </a>
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

    @if($Recommendation)
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Recommended Solution/s</strong></h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Recommendation</th>
                                <th>Priority</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Recommendation as $item)
                            @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                            <tr>
                                <td>{{ $item->Recommendation }}</td>
                                <td>{{ $item->Priority }}</td>
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

    <div class="d-flex justify-content-center">
        <div class="p-2">
            <a href="{{ url('pialist') }}" class="btn btn-secondary">Back</a>
        </div>
      
        <div class="p-2">
        @if (auth()->user()->usertype == 'admin')
            <form action="validatePIA" method="POST">
                @csrf
                <input type="hidden" name="PrivacyImpactAssessmentID" value="{{ $PrivacyImpactAssessment->PrivacyImpactAssessmentID }}">
                @if ($PrivacyImpactAssessment->Validated == false)    
                    <div width="100%">
                        <button type="submit" name="button" value="validate" class="btn btn-success btn-lg">Validate</button>
                    </div>
                @else
                    <div width="100%">
                        <button type="submit" name="button" value="invalidate" class="btn btn-danger btn-lg">Invalidate</button>
                    </div>
                @endif
            </form>
        @endif
        </div>
    </div>
</div>

@endsection
