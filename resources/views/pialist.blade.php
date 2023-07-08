
@extends('layouts.sidebar_layout')

@section('title', 'PIA')

@section('content')

    @if ($PrivacyImpactAssessment->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Privacy Impact Assessment</h3>
            </div>    <!-- /card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Version</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PrivacyImpactAssessment as $item)
                            @if ($item->UserID == $UserID)
                                    <tr>
                                        <td>{{ $item->PrivacyImpactAssessmentVersionID }}</td>
                                        <td>{{ $item->Name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                        <div class="d-flex flex-row-reverse">
                                            <div class="p-2">
                                                <form action='proceed_to_process' method='POST'>
                                                    @csrf
                                                    <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                        Edit        
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="p-2">
                                                <form action='view_pia' method='POST' class="">
                                                    @csrf
                                                    <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                        View        
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /card-body -->
        </div> <!-- /card -->
    @else
        <p>There are no PIA yet.</p>
    @endif

@stop