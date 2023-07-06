
@extends('layouts.sidebar_layout')

@section('title', '')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Privacy Impact Assessment List</title>
</head>
<body>
    <h1>Privacy Impact Assessment List</h1>

    <table>
        <thead>
            <tr>
                <th>Privacy Impact Assessment</th>
                <th>Process</th>
                <th>Data Fields</th>
                <th>Risk Management</th>
                <th>Data Flow</th>
            </tr>
        </thead>
        <tbody>
            @foreach($privacyImpactAssessments as $pia)
            <tr>
                <td>
                    <strong>ID:</strong> {{ $pia->PrivacyImpactAssessmentID }}<br>
                    <strong>User ID:</strong> {{ $pia->UserID }}<br>
                    <strong>Version:</strong> {{ $pia->Version }}<br>
                    <strong>Name:</strong> {{ $pia->Name }}<br>
                    <strong>Created At:</strong> {{ $pia->created_at }}<br>
                    <strong>Updated At:</strong> {{ $pia->updated_at }}
                </td>
                <td>
                    <strong>Process ID:</strong> {{ $pia->process->ProcessID }}<br>
                    <strong>Process Name:</strong> {{ $pia->process->ProcessName }}<br>
                    <strong>Form Used:</strong> {{ $pia->process->FormUsed }}<br>
                    <strong>Data Collected:</strong> {{ implode(', ', $pia->process->Datacollected) }}<br>
                    <strong>Purpose for Processing:</strong> {{ $pia->process->PurposeforProcessing }}<br>
                    <strong>Security Measure:</strong> {{ $pia->process->SecurityMeasure }}<br>
                    <strong>Process Narrative:</strong> {{ $pia->process->ProcessNarrative }}
                </td>
                <td>
                    @foreach($pia->process->dataFields as $dataField)
                        <strong>Data Field ID:</strong> {{ $dataField->DataFieldsID }}<br>
                        <strong>Form Used:</strong> {{ $dataField->FormUsed }}<br>
                        <strong>Data Collected:</strong> {{ implode(', ', $dataField->Datacollected) }}<br>
                        <br>
                    @endforeach
                </td>
                <td>
                    @foreach($pia->riskManagements as $riskManagement)
                        <strong>Risk Management ID:</strong> {{ $riskManagement->RiskManagementID }}<br>
                        <strong>Threats/Vulnerabilities:</strong> {{ $riskManagement->ThreatsVulnerabilities }}<br>
                        <strong>Impact:</strong> {{ $riskManagement->Impact }}<br>
                        <strong>Probability:</strong> {{ $riskManagement->Probability }}<br>
                        <strong>Risk Rating:</strong> {{ $riskManagement->RiskRating }}<br>
                        <br>
                    @endforeach
                </td>
                <td>
                    @foreach($pia->dataFlows as $dataFlow)
                        <strong>Data Flow ID:</strong> {{ $dataFlow->DataFlowID }}<br>
                        <strong>File Name:</strong> {{ $dataFlow->FileName }}<br>
                        <br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</



@stop