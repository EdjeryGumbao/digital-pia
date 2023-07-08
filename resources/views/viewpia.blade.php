@extends('layouts.sidebar_layout')

@section('title', 'Privacy Impact Assessment List')

@section('content')
    <img src="img/USEP_Logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <h2>University of Southeastern Philippines</h2>

    <h2>PRIVACY IMPACT ASSESSMENT</h2>

    <table>
        <tbody>
            @if($Process)
                <tr>
                    <td>
                        <strong>Process Name:</strong><br>
                        {{ $Process->ProcessName }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Data Subject:</strong><br>
                        {{ $Process->DataSubject  }}
                    </td>
                </tr>

        @if(isset($DataFields))
            @foreach ($DataFields as $item)
                @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                    <table>
                        <tr>
                            <th>{{ $item->FormUsed }}: </th>
                            <td>{{ implode(', ', $item->Datacollected) }}</td>
                        </tr>
                    </table>
                @endif
            @endforeach
        @endif

                <tr>
                    <td></td>
                </tr>
            @endif
            <tr>
                <td>
                        
                            
                            
                        
                        <strong>Purpose for Processing:</strong> {{ $Process->PurposeforProcessing }}<br>
                        <strong>Security Measure:</strong> {{ $Process->SecurityMeasure }}<br>
                        <strong>Process Narrative:</strong> {{ $Process->ProcessNarrative }}<br>
                </td>
                <td>
                    @if($RiskManagement)
                        <strong>Risk Management ID:</strong> {{ $RiskManagement->RiskManagementID }}<br>
                        <strong>Threats/Vulnerabilities:</strong> {{ $RiskManagement->ThreatsVulnerabilities }}<br>
                        <strong>Impact:</strong> {{ $RiskManagement->Impact }}<br>
                        <strong>Probability:</strong> {{ $RiskManagement->Probability }}<br>
                        <strong>Risk Rating:</strong> {{ $RiskManagement->RiskRating }}<br>
                        <br>
                    @endif
                </td>
                <td>
                    @if($DataFlow)
                        <strong>Data Flow ID:</strong> {{ $DataFlow->DataFlowID }}<br>
                        <strong>File Name:</strong> {{ $DataFlow->FileName }}<br>
                        <br>
                    @endif
                </td>
            </tr>

        </tbody>
    </table>
@endsection
