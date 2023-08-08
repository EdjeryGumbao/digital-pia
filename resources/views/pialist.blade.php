
@extends('layouts.sidebar_layout')

@section('title', 'Privacy Impact Assessment List')

@section('content')



<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    @if ($PrivacyImpactAssessment->count() > 0)
    <!--
        <form action="{{ url('pialistsearch') }}" method="GET">
            <input type="text" name="keyword" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    -->
        <form action="" method="GET">
            <div class="row mb-3 p-2">
                <div class="col-md-3">
                    <label for="Department">Department</label>
                    <select name="Department" class="form-control">
                        <option value="">No selected</option>
                        <option value="Board of Regents">Board of Regents</option>
                        <option value="Office of the President">Office of the President</option>
                        <option value="Office of the Vice President for Academic Affairs">Office of the Vice President for Academic Affairs</option>
                        <option value="Office of the Vice President for Administration">Office of the Vice President for Administration</option>
                        <option value="Office of the Vice President for Planning and Quality Assurance">Office of the Vice President for Planning and Quality Assurance</option>
                        <option value="Office of the Vice President for Research, Development and Extension">Office of the Vice President for Research, Development and Extension</option>
                        <option value="Office of the Secretary of the University and the University Records Office">Office of the Secretary of the University and the University Records Office</option>
                        <option value="Office of Legal Affairs">Office of Legal Affairs</option>
                        <option value="International Affairs Division">International Affairs Division</option>
                        <option value="Public Affairs Division">Public Affairs Division</option>
                        <option value="Office of Advance Studies">Office of Advance Studies</option>
                        <option value="Human Resource Management Division">Human Resource Management Division</option>
                        <option value="Administrative Services Division">Administrative Services Division</option>
                        <option value="Physical Development Division">Physical Development Division</option>
                        <option value="Gender and Development Office">Gender and Development Office</option>
                        <option value="Bids &amp; Awards Committee">Bids &amp; Awards Committee</option>
                        <option value="Office of Student Affairs and Services">Office of Student Affairs and Services</option>
                        <option value="Office of the University Registrar">Office of the University Registrar</option>
                        <option value="University Assessment and Guidance Center">University Assessment and Guidance Center</option>
                        <option value="University Learning Resource Center">University Learning Resource Center</option>
                        <option value="Resource Management Division">Resource Management Division</option>
                        <option value="Health Services Division">Health Services Division</option>
                        <option value="University Finance Division">University Finance Division</option>
                        <option value="Research, Development and Extension">Research, Development and Extension</option>
                        <option value="College of Agriculture and Related Sciences">College of Agriculture and Related Sciences</option>
                        <option value="College of Arts and Sciences">College of Arts and Sciences</option>
                        <option value="College of Business Administration">College of Business Administration</option>
                        <option value="College of Development Management">College of Development Management</option>
                        <option value="College of Education">College of Education</option>
                        <option value="College of Engineering">College of Engineering</option>
                        <option value="College of Teacher Education and Technology">College of Teacher Education and Technology</option>
                        <option value="College of Technology">College of Technology</option>
                        <option value="College of Information and Computing">College of Information and Computing</option>
                        <option value="College of Applied Economics">College of Applied Economics</option>
                        <option value="School of Law">School of Law</option>
                        <option value="School of Medicine">School of Medicine</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="">Search</label>
                    <input type="text" class="form-control" name="search"> 
                </div>
                <div class="col-md-2">
                    <label for="">Per Page</label>
                    <select class="form-control" name="perPage">
                        <option value="25">25</option>
                        <option value="15">15</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Status</label>
                    <select class="form-control" name="sortBy">
                        <option value="asc">Newest</option> <option value="desc">Oldest</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Filter</label>
                    <button type='submit' class='btn btn-primary btn-sm form-control'>
                        Submit
                    </button>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title"><strong>Privacy Impact Assessment List</strong></h3>
                </div>
            </div>    <!-- /card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="200" class="text-center">
                                @sortablelink('PIAVersion', 'PIA Version')
                                
                            </th>
                            @if ($CurrentUser->usertype == "admin")
                                <th width="300" class="text-center">@sortablelink('Author', 'Department')</th>
                            @endif
                            <th width="200" class="text-center">@sortablelink('ProcessName', 'Process Name')</th>
                            <th width="200" class="text-center">@sortablelink('created_at', 'Date Created')</th>
                            <th width="200" class="text-center">@sortablelink('updated_at', 'Date Updated')</th>
                            <th width="100" class="text-center">@sortablelink('Status', 'Status')</th>
                            <th width="300" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PrivacyImpactAssessment as $item)
                            @if ($CurrentUser->usertype == "user")
                                @if ($item->UserID == $CurrentUser->id)
                                    <tr>
                                        <td class="p-2 text-center"> {{ $item->PIAVersion }} </td>
                                        <td class="p-2"> {{ $item->ProcessName }} </td>
                                        <td class="p-2 text-center"> {{ $item->created_at->format('F d, Y') }} </td>
                                        <td class="p-2 text-center"> {{ $item->updated_at->format('F d, Y') }} </td>
                                        @if ($item->Status == 'Validated')
                                            <td class="p-1 text-center">
                                                <span class="text-success font-weight-bold">Validated</span>
                                            </td>
                                        @elseif ($item->Status == 'Pending')
                                            <td class="p-1 text-center">
                                                <span class="text-warning font-weight-bold">Pending</span>
                                            </td>
                                        @elseif ($item->Status == 'Needs Revision')
                                            <td class="p-1 text-center">
                                                <span class="text-danger font-weight-bold">Needs Revision</span>
                                            </td>
                                        @elseif ($item->Status == 'Revised')
                                            <td class="p-1 text-center">
                                                <span class="text-primary font-weight-bold">Revised</span>
                                            </td>
                                        @endif
                                        <td>
                                        <div class="d-flex flex-row-reverse justify-content-center">
                                            @if ($item->Status != 'Validated')
                                            <div class="p-1">
                                                <form action='delete_pia' method='POST' class="">
                                                    @csrf
                                                    <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-danger btn-sm' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="p-1">
                                                <form action='proceed_to_process' method='POST'>
                                                    @csrf
                                                    <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary btn-sm' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                        <i class="fa fa-pencil-square-o"></i> Edit
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                            <div class="p-1">
                                                <form action='view_pia' method='POST' class="">
                                                    @csrf
                                                    <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary btn-sm' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                        <i class="fa fa-eye"></i> View
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="p-1">
                                                <form action='view_pia' method='POST' class="">
                                                    @csrf
                                                    <input type='hidden' name='download' value='true'>
                                                    <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary btn-sm' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                        <i class="fa fa-download"></i> PDF
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                @endif
                            @elseif ($CurrentUser->usertype == "admin")
                                <tr>
                                    <td class="p-2 text-center"> {{ $item->PIAVersion }} </td>
                                    <td class="p-2"> {{ $item->Department }} </td>
                                    <td class="p-2"> {{ $item->ProcessName }} </td>
                                    <td class="p-2 text-center"> {{ $item->created_at->format('F d, Y') }} </td>
                                    <td class="p-2 text-center"> {{ $item->updated_at->format('F d, Y') }} </td>
                                    @if ($item->Status == 'Validated')
                                        <td class="p-2 text-center">
                                            <span class="text-success font-weight-bold">Validated</span>
                                        </td>
                                    @elseif ($item->Status == 'Pending')
                                        <td class="p-2 text-center">
                                            <span class="text-warning font-weight-bold">Pending</span>
                                        </td>
                                    @elseif ($item->Status == 'Needs Revision')
                                        <td class="p-2 text-center">
                                            <span class="text-danger font-weight-bold">Needs Revision</span>
                                        </td>
                                    @elseif ($item->Status == 'Revised')
                                        <td class="p-2 text-center">
                                            <span class="text-primary font-weight-bold">Revised</span>
                                        </td>
                                    @endif
                                    <td>
                                        <div class="d-flex flex-row-reverse justify-content-center">
                                            <div class="p-1">
                                                <form action='delete_pia' method='POST' class="">
                                                    @csrf
                                                    <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-danger btn-sm' value='{{ $item->PrivacyImpactAssessmentID }}' onclick="return confirmDelete()">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="p-1">
                                                <form action='view_pia' method='POST' class="">
                                                    @csrf
                                                    <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary btn-sm' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                        <i class="fa fa-eye"></i> View
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="p-1">
                                                <form action='view_pia' method='POST' class="">
                                                    @csrf
                                                    <input type='hidden' name='download' value='true'>
                                                    <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary btn-sm' value='{{ $item->PrivacyImpactAssessmentID }}'>
                                                        <i class="fa fa-download"></i> PDF
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
    <!-- Display the pagination links -->
    <div class="d-flex justify-content-center">
        {{ $PrivacyImpactAssessment->links() }}
    </div>

    <script>
        function confirmDelete() {
            // Show a pop-up dialog with a confirmation message
            const confirmation = confirm("Are you sure you want to delete this? This action cannot be undone.");

            // If the user clicks "OK," the form will be submitted; otherwise, the deletion process will be canceled.
            return confirmation;
        }
    </script>

@stop