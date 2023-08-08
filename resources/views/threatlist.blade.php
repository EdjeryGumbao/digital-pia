
@extends('layouts.sidebar_layout')

@section('title', 'Risk Assessment List')

@section('content')
    @if ($RiskAssessment->count() > 0)
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
                <h3 class="card-title">Risk Assessment List</h3>
            </div>    <!-- /card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="300" class="text-center">Department</th>
                            <th width="200" class="text-center">Process Name</th>
                            <th width="300" class="text-center">@sortablelink('ThreatsVulnerabilities', 'Threats/Vulnerabilities')</th>
                            <th width="180" class="text-center">@sortablelink('RiskRating', 'Risk Rating')</th>
                            <th width="180" class="text-center">@sortablelink('created_at', 'Date Created')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($RiskAssessment as $item)
                            <tr>
                                @foreach($PrivacyImpactAssessment as $item2)
                                    @if ($item->PrivacyImpactAssessmentID == $item2->PrivacyImpactAssessmentID)
                                        <td>
                                            {{ $item2->Department }}
                                        </td>
                                        <td>
                                            {{ $item2->ProcessName }}
                                        </td>
                                    @endif
                                @endforeach
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
                                <td class="text-center">{{ $item->created_at->format('Y, F d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /card-body -->
        </div> <!-- /card -->
    @else
        <p>There are no Threat and Vulnerabilities listed yet.</p>
    @endif

    <!-- Display the pagination links -->
    <div class="d-flex justify-content-center">
        {{ $RiskAssessment->links() }}
    </div>
@stop