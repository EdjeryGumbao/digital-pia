
@extends('layouts.sidebar_layout')

@section('title', 'Risk Assessment List')

@section('content')
    @if ($RiskAssessment->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Risk Assessment List</h3>
            </div>    <!-- /card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Process Name</th>
                            <th width="80px">@sortablelink('ThreatsVulnerabilities', 'Threats/Vulnerabilities')</th>
                            <th>@sortablelink('RiskRating', 'Risk Rating')</th>
                            <th>@sortablelink('created_at')</th>
                            <th>@sortablelink('updated_at')</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($RiskAssessment as $item)
                            <tr>
                                <td>
                                    @foreach($PrivacyImpactAssessment as $item2)
                                        @if ($item->PrivacyImpactAssessmentID == $item2->PrivacyImpactAssessmentID)
                                            {{ $item2->ProcessName }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $item->ThreatsVulnerabilities }}</td>
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
                                <td>{{ $item->created_at->format('Y, F d') }}</td>
                                <td>{{ $item->updated_at->format('Y, F d') }}</td>
                                <td>
                                    @foreach($PrivacyImpactAssessment as $item2)
                                        @if ($item->PrivacyImpactAssessmentID == $item2->PrivacyImpactAssessmentID)
                                            {{ $item2->Author }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /card-body -->
        </div> <!-- /card -->
    @else
        <p>There are no Threat and Vulnerabilities listed yet.</p>
    @endif
@stop