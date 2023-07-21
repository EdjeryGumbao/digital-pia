@extends('layouts.sidebar_layout')

@section('title', 'D. Recommendation')

@section('content')

<h3><strong>Recommended Solutions</strong></h3>
<form method="POST" action="{{ route('InsertRecommendation') }}">
  @csrf

  <p style='margin-bottom:0px;'>Identify the recommended solutions or mitigation measures, along with their corresponding priority numbers, and indicate the level of prioritization you believe they should receive.</p>
  <p>In the same column, you have the option to cite the existing controls you've implemented to mitigate the risks.</p>
  <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Recommended Solutions</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th width="75%">Recommendation</th>
                    <th width="15%">Priority Number</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" class="form-control" name="Recommendation">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="Priority">
                    </td>
                    <td >
                        <button type="submit" class="btn btn-success">Add</button>
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
          <th>Recommendation</th>
          <th>Priority</th>
        </tr>
      </thead>
      <tbody>
      @if(isset($Recommendation))
          @foreach ($Recommendation as $item)
              @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                  <tr>
                      <td>{{ $item->Recommendation }}</td>
                      <td>{{ $item->Priority }}</td>
                      <td>
                        <form action="delete_recommendation" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger" name="RecommendationID" value="{{ $item->RecommendationID }}" onclick="return confirmDelete()">Delete</button>
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

<div class="d-flex">
    <div class="p-2">
        <form action="proceed_to_flowchart" method="post">
            @csrf
            <button type="submit" class="btn btn-secondary">Back</button>
        </form>
    </div>
    <div class="ml-auto p-2">
        <form action="proceed_to_end" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Finish</button>
        </form>
    </div>
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
