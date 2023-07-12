
@extends('layouts.sidebar_layout')

@section('title', 'Privacy Impact Assessment List')

@section('content')
    @if ($PrivacyImpactAssessment->count() > 0)
    <!--
        <form action="{{ url('pialistsearch') }}" method="GET">
            <input type="text" name="keyword" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Privacy Impact Assessment List</strong></h3>
            </div>    <!-- /card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            @if ($CurrentUser->usertype == "admin")
                                <th>@sortablelink('Author', 'Department')</th>
                            @endif
                            <th width="80px">@sortablelink('Version')</th>
                            <th>@sortablelink('ProcessName')</th>
                            <th>@sortablelink('created_at')</th>
                            <th>@sortablelink('updated_at')</th>
                            <th>@sortablelink('CheckMark', 'Validated')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PrivacyImpactAssessment as $item)
                            @if ($CurrentUser->usertype == "user")
                                @if ($item->UserID == $CurrentUser->id)
                                        <tr>
                                            <td>{{ $item->Version }}</td>
                                            <td>{{ $item->ProcessName }}</td>
                                            <td>{{ $item->created_at->format('F d, Y') }}</td>
                                            <td>{{ $item->updated_at->format('F d, Y') }}</td>
                                            <td>
                                                @if ($item->CheckMark)
                                                    <div class="p-2">
                                                        <span class="text-success">Validated</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                            <div class="d-flex flex-row-reverse">
                                                @if (!$item->CheckMark)
                                                <div class="p-2">
                                                    <form action='delete_pia' method='POST' class="">
                                                        @csrf
                                                        <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-danger' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                            Delete        
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="p-2">
                                                    <form action='proceed_to_process' method='POST'>
                                                        @csrf
                                                        <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                            Edit        
                                                        </button>
                                                    </form>
                                                </div>
                                                @endif
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
                                    <td>
                                        @foreach ($User as $useritem)
                                            @if ($useritem->id == $item->UserID)
                                                {{ $useritem->username ?? ''}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $item->Version }}</td>
                                    <td>{{ $item->ProcessName }}</td>
                                    <td>{{ $item->created_at->format('Y, F d') }}</td>
                                    <td>{{ $item->updated_at->format('Y, F d') }}</td>
                                    <td>
                                        <div class="p-2">
                                            @if ($item->CheckMark)
                                                <span class="text-success">Validated</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                    <div class="d-flex flex-row-reverse">
                                        <div class="p-2">
                                            <form action='delete_pia' method='POST' class="">
                                                @csrf
                                                <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-danger' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                    Delete        
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