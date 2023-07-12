
@extends('layouts.sidebar_layout')

@section('title', 'Data Flow List')

@section('content')
    @if ($DataFlow->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Flow List</h3>
            </div>    <!-- /card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="80px">Department</th>
                            <th>@sortablelink('created_at')</th>
                            <th>@sortablelink('updated_at')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($DataFlow as $item)
                            <tr>
                                <td>
                                    @foreach($PrivacyImpactAssessment as $item2)
                                        @if ($item->PrivacyImpactAssessmentID == $item2->PrivacyImpactAssessmentID)
                                            {{ $item2->Author }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $item->created_at->format('Y, F d') }}</td>
                                <td>{{ $item->updated_at->format('Y, F d') }}</td>
                                <td>
                                    <a href="/images/{{ $item->FileName }}" target="_blank">
                                        <img src="/images/{{ $item->FileName }}" alt="{{ $item->FileName }}" class="card-img-top">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /card-body -->
        </div> <!-- /card -->
    @else
        <p>There are no Data Flowchart listed yet.</p>
    @endif
@stop