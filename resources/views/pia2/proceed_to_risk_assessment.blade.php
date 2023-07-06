@extends('layouts.sidebar_layout')

@section('title', 'B. Risk Assessment')

@section('content')

<p>Welcome to the Risk Assessment</p>

<p>For the purpose of this section, a risk refers to the potential of an incident to result in harm or danger 
to a data subject or organization. Risks are those that could lead to the unauthorized collection, use, 
disclosure or access to personal data. It includes risks that the confidentiality, integrity and availability 
of personal data will not be maintained, or the risk that processing will violate rights of data subjects 
or privacy principles (transparency, legitimacy and proportionality).</p>
<p>The first step in managing risks is to identify them, including threats and vulnerabilities, and by 
evaluating its impact and probability</p>
           
<div class="card">
  <div class="card-header">
    <h3 class="card-title">The following definitions are used in this section,</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tbody>
        <tr>
          <th>Risk</th>
          <td>the potential for loss, damage or destruction as a result of a threat exploiting a vulnerability;</td>
        </tr>
        <tr>
          <th>Threat</th>
          <td>a potential cause of an unwanted incident, which may result in harm to a system or organization;</td>
        </tr>
        <tr>
          <th>Vulnerability</th>
          <td>a weakness of an asset or group of assets that can be exploited by one or more threats;</td>
        </tr>
        <tr>
          <th>Impact</th>
          <td>everity of the injuries that might arise if the event does occur (can be ranked from trivial injuries to major injuries); and</td>
        </tr>
        <tr>
          <th>Probability</th>
          <td>chance or probability of something happening;</td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
           
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Impact</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>Rating</th>
          <th>Types</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Negligible</td>
          <td>The data subjects will either not be affected or may encounter a few inconveniences, which they will overcome without any problem.</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Limited</td>
          <td>The data subject may encounter significant inconveniences, which they will be able to overcome despite a few difficulties.</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Significant</td>
          <td>The data subjects may encounter significant inconveniences, which they should be able to overcome but with serious difficulties.</td>
        </tr>
        <tr>
          <td>4</td>
          <td>Maximum</td>
          <td>The data subjects may encounter significant inconveniences, or even irreversible, consequences, which they may not overcome.</td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Probability</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>Rating</th>
          <th>Types</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Unlikely</td>
          <td>Not expected, but there is a slight possibility it may occur at some time.</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Possible</td>
          <td>	Casual occurrence. It might happen at some time.</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Likely</td>
          <td>Frequent occurrence. There is a strong possibility that it might occur.</td>
        </tr>
        <tr>
          <td>4</td>
          <td>Almost </td>
          <td>Very likely. It is expected to occur in most circumstances.</td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<p>Please input your data in the following table</p>

<form method="POST" action="InsertRiskManagement">
  @csrf
  <div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">Risk Assessment</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-8">
          <label for="ThreatsVulnerabilities">Threat/Vulnerability</label>
          <input type="text" class="form-control" name="ThreatsVulnerabilities">
        </div>
        <div class="col-2">
        <label for="Impact">Impact</label>
        <input type="text" class="form-control" name="Impact">
        </div>
        <div class="col-2">
        <label for="Probability">Probability</label>
        <input type="text" class="form-control" name="Probability">
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <button type="submit" class="btn btn-success">Add</button>
  </div>

  @if (session('success'))
    <div>
      <p class="text-success">{{ session('message') }}</p>
    </div>
  @endif

  @foreach ($errors->all() as $error)
      <p class="text-danger">{{ $error }}</p>
  @endforeach


</form>

<div class="card">
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>Threat/Vulnerability</th>
          <th>Impact</th>
          <th>Probability</th>
          <th>Risk</th>
        </tr>
      </thead>
      <tbody>
      @if(isset($RiskManagement))
          @foreach ($RiskManagement as $item)
              @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                  <tr>
                      <td>{{ $item->ThreatsVulnerabilities }}</td>
                      <td>{{ $item->Impact }}</td>
                      <td>{{ $item->Probability }}</td>
                      <td>{{ $item->RiskRating }}</td>
                      <td>
                        <form action="delete_riskmanagement" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger" name="RiskManagementID" value="{{ $item->RiskManagementID }}">Delete</button>
                        </form>
                      </td>
                  </tr>
              @endif
          @endforeach
      @endif
    </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<div class="d-flex">
  <div class="p-2">
    <form action="proceed_to_process" method="post">
      @csrf
      <button type="submit" class="btn btn-secondary">Back</button>
    </form>
  </div>
  <div class="ml-auto p-2">
    <form action="proceed_to_flowchart" method="post">
      @csrf
      <button type="submit" class="btn btn-primary">Next</button>
    </form>
  </div>
</div>

@stop


