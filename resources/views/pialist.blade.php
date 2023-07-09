
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
                            <th width="80px">@sortablelink('Version')</th>
                            @if ($CurrentUser->usertype == "admin")
                                <th>@sortablelink('completename', 'Author')</th>
                            @endif
                            <th>@sortablelink('ProcessName')</th>
                            <th>@sortablelink('created_at')</th>
                            <th>@sortablelink('updated_at')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PrivacyImpactAssessment as $item)
                            @if ($CurrentUser->usertype == "user")
                                @if ($item->UserID == $CurrentUser->id)
                                        <tr>
                                            <td>{{ $item->PrivacyImpactAssessmentVersionID }}</td>
                                            <td>{{ $item->ProcessName }}</td>
                                            <td>{{ $item->created_at->format('F d, Y') }}</td>
                                            <td>{{ $item->updated_at->format('F d, Y') }}</td>
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
                            @elseif ($CurrentUser->usertype == "admin")
                                <tr>
                                    <td>{{ $item->PrivacyImpactAssessmentVersionID }}</td>
                                    @foreach ($User as $useritem)
                                        @if ($useritem->id == $item->UserID)
                                            <td>{{ $useritem->completename }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $item->ProcessName }}</td>
                                    <td>{{ $item->created_at->format('F d, Y') }}</td>
                                    <td>{{ $item->updated_at->format('F d, Y') }}</td>
                                    <td>
                                    <div class="d-flex flex-row-reverse">
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