@extends('layouts.sidebar_layout')

@section('title', 'B. Risk Assessment')

@section('content')


<h3><strong>Risk Assessment</strong></h3>
<p>
  In this form you will be using the risk level calculator you will simply input the Identified threat/vulnerability and 
  choose what level of Impact and probability it has on the process.
</p>

<form method="POST" action="{{ route('InsertRiskAssessment') }}">
  @csrf
  <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Risk Assessment</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th width="70%">Threat/Vulnerability</th>
                    <th width="10%">Impact</th>
                    <th width="10%">Probability</th>
                    <th width="10%"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" class="form-control" name="ThreatsVulnerabilities">
                    </td>
                    <td>
                        <select class="form-control" name="Impact">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="Probability">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>

                    <td>
                        <button type="submit" class="btn btn-success">Calculate</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
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
      @if(isset($RiskAssessment))
          @foreach ($RiskAssessment as $item)
              @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                  <tr>
                      <td>{{ $item->ThreatsVulnerabilities }}</td>
                      <td class="text-center">{{ $item->Impact }}</td>
                      <td class="text-center">{{ $item->Probability }}</td>
                      <td class="text-center" style="background-color: 
                          @if($item->RiskRating == 1) #fafdff /* white */
                          @elseif($item->RiskRating >= 2 && $item->RiskRating <= 5) #ffffcc /* light yellow */
                          @elseif($item->RiskRating >= 6 && $item->RiskRating <= 8) #ffff99 /* yellow */
                          @elseif($item->RiskRating == 9) #ffcccc /* lighter red */
                          @elseif($item->RiskRating >= 10 && $item->RiskRating <= 15) #ff9999 /* light red */
                          @elseif($item->RiskRating >= 16) #ff0000 /* red */
                          @endif;
                          color: {{ $item->RiskRating == 16 ? '#ffffff' : '#000000' }};">
                          {{ $item->RiskRating }}
                      </td>
                      <td>
                        <form action="delete_riskassessment" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger" name="RiskAssessmentID" value="{{ $item->RiskAssessmentID }}">Delete</button>
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
</div><br>

<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Toggle Description
</button>
<div class="collapse" id="collapseExample">
  <h3><strong>Description</strong></h3>

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


