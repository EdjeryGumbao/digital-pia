
@extends('layouts.sidebar_layout')

@section('title', 'Recommendation List')

@section('content')
    @if ($Recommendation->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recommendation List</h3>
            </div>    <!-- /card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="80px">Department</th>
                            <th>Process name</th>
                            <th>Recommendation</th>
                            <th>Priority</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Recommendation as $item)
                            <tr>
                                @foreach($PrivacyImpactAssessment as $item2)
                                    @if ($item->PrivacyImpactAssessmentID == $item2->PrivacyImpactAssessmentID)
                                        <td>
                                            @foreach($User as $item3)
                                                @if ($item2->UserID == $item3->id)
                                                    {{ $item3->department }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $item2->ProcessName }}
                                        </td>
                                    @endif
                                @endforeach
                                <td>{{ $item->Recommendation }}</td>
                                <td>{{ $item->Priority }}</td>
                                <td>{{ $item->created_at->format('Y, F d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /card-body -->
        </div> <!-- /card -->
    @else
        <p>There are no Recommendation listed yet.</p>
    @endif
@stop