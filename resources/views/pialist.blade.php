
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
                            <th width="80px">@sortablelink('PIAVersion', 'PIA Version')</th>
                            <th>@sortablelink('ProcessName')</th>
                            <th>@sortablelink('created_at')</th>
                            <th>@sortablelink('updated_at')</th>
                            <th>@sortablelink('Validated', 'Validated')</th>
                            <th style='text-align:center;'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PrivacyImpactAssessment as $item)
                            @if ($CurrentUser->usertype == "user")
                                @if ($item->UserID == $CurrentUser->id)
                                        <tr>
                                            <td><div class="p-2">{{ $item->PIAVersion }}</div></td>
                                            <td><div class="p-2">{{ $item->ProcessName }}</div></td>
                                            <td><div class="p-2">{{ $item->created_at->format('F d, Y') }}</div></td>
                                            <td><div class="p-2">{{ $item->updated_at->format('F d, Y') }}</div></td>
                                            @if ($item->Validated)
                                                <td>
                                                    <div class="p-2"><span class="text-success font-weight-bold">Validated</span></div>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="p-2"><span class="text-warning font-weight-bold">Pending</span></div>
                                                </td>
                                            @endif
                                            <td>
                                            <div class="d-flex flex-row-reverse">
                                                @if (!$item->Validated)
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
                                                <div class="p-2">
                                                    <form action='view_pia' method='POST' class="">
                                                        @csrf
                                                        <input type='hidden' name='download' value='true'>
                                                        <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                            Download PDF
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                @endif
                            @elseif ($CurrentUser->usertype == "admin")
                                <tr>
                                    <td><div class="p-2">{{ $item->Department }}</div></td>
                                    <td><div class="p-2">{{ $item->PIAVersion }}</div></td>
                                    <td><div class="p-2">{{ $item->ProcessName }}</div></td>
                                    <td><div class="p-2">{{ $item->created_at->format('F d, Y') }}</div></td>
                                    <td><div class="p-2">{{ $item->updated_at->format('F d, Y') }}</div></td>
                                    @if ($item->Validated)
                                        <td>
                                            <div class="p-2"><span class="text-success font-weight-bold">Validated</span></div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="p-2"><span class="text-warning font-weight-bold">Pending</span></div>
                                        </td>
                                    @endif
                                    <td>
                                    <div class="d-flex flex-row-reverse">
                                        <div class="p-2">
                                            <form action='delete_pia' method='POST' class="">
                                                @csrf
                                                <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-danger' value='{{ $item->PrivacyImpactAssessmentID }}' onclick="return confirmDelete()">
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
                                        <div class="p-2">
                                            <form action='view_pia' method='POST' class="">
                                                @csrf
                                                <input type='hidden' name='download' value='true'>
                                                <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                    Download PDF       
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

<script>
    function confirmDelete() {
        // Show a pop-up dialog with a confirmation message
        const confirmation = confirm("Are you sure you want to delete this? This action cannot be undone.");

        // If the user clicks "OK," the form will be submitted; otherwise, the deletion process will be canceled.
        return confirmation;
    }
</script>
@stop

