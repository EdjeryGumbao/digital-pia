@extends('layouts.sidebar_layout')

@section('title', 'A. Process')

@section('content')


@foreach ($errors->all() as $error)
    <p class="text-danger">{{ $error }}</p>
@endforeach


<form action="InsertProcess" method="post" id="processForm">
    @csrf
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Process</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label for="DataSubject">Data Subject:</label>
                    <input type="text" class="form-control" name="DataSubject" value="{{ $Process->DataSubject ?? ''}}" >
                </div>
                <div class="form-group">
                    <label for="FormUsed">Form used:</label>
                    <input type="text" class="form-control" name="FormUsed">
                    <label for="Datacollected[]">Data Fields:</label>
                    <div id="inp-group"></div>
                    <button id="add" type="button" class="btn btn-secondary">Add Data field</button>
                    <button type="submit" class="btn btn-primary" name="Button" value="FormData">Save</button>
                </div>

<div class="card">
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tbody>
        @if(isset($DataFields))
            @foreach ($DataFields as $item)
                @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                    <tr>
                        <td>
                            <strong>{{ $item->FormUsed }}:</strong>
                        </td>
                        <td>
                            {{ implode(', ', $item->Datacollected) }}
                        </td>
                        <td class="d-flex flex-row-reverse">
                            <div class="d-flex flex-row-reverse">
                                <div class="p-2">
                                    <button type="submit" class="btn btn-danger" name="delete_datafield" value="{{ $item->DataFieldsID }}">Delete</button>
                                </div>
                            </div>
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


                <div class="form-group">
                    <label for="PurposeforProcessing">Purpose/s for Processing:</label>
                    <textarea type="text" class="form-control" name="PurposeforProcessing" row="2">{{ $Process->PurposeforProcessing ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SecurityMeasure">Security Measure/s:</label>
                    <textarea type="text" class="form-control" name="SecurityMeasure" row="2">{{ $Process->SecurityMeasure ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="ProcessNarrative">Process Narrative:</label>
                    <textarea type="text" class="form-control" name="ProcessNarrative" row="2">{{ $Process->ProcessNarrative ?? ''}}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <br>
        <h1>Process-level Analysis: Data Lifecycle</h1>
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Data Collection</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="SectionA">
                <div class="form-group">
                    <label for="SectionA">Data Source:</label>
                    <textarea type="text" class="form-control" row="2" name="SectionA[]">{{ $Process->SectionA[0] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SectionA">Collection Method:</label>
                    <textarea type="text" class="form-control" row="2" name="SectionA[]">{{ $Process->SectionA[1] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SectionA">Timing of Collection:</label>
                    <textarea type="text" class="form-control" row="2" name="SectionA[]">{{ $Process->SectionA[2] ?? '' }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-header">
            <h3 class="card-title">Data Use</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="SectionB">
                <div class="form-group">
                    <label for="SectionB">Is the data being used as is, or does it undergo further processing?</label>
                    <textarea type="text" class="form-control" row="2" name="SectionB[]">{{ $Process->SectionB[0] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SectionB">Is there automated decision-making?</label>
                    <textarea type="text" class="form-control" row="2" name="SectionB[]">{{ $Process->SectionB[1] ?? '' }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-header">
            <h3 class="card-title">Data Disclosure</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="SectionC">
                <div class="form-group">
                    <label for="SectionC">Is data being transferred to third parties?</label>
                    <textarea type="text" class="form-control" row="2" name="SectionC[]">{{ $Process->SectionC[0] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SectionC">Third-party recipients</label>
                    <textarea type="text" class="form-control" row="2" name="SectionC[]">{{ $Process->SectionC[1] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SectionC">Purpose/s of the transfer to the third party?</label>
                    <textarea type="text" class="form-control" row="2" name="SectionC[]">{{ $Process->SectionC[2] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SectionC">Is the data transfer supported by a data sharing agreement or a data outsourcing agreement?</label>
                    <textarea type="text" class="form-control" row="2" name="SectionC[]">{{ $Process->SectionC[3] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SectionC">Is the personal data transferred outside of the Philippines? If so, where?</label>
                    <textarea type="text" class="form-control" row="2" name="SectionC[]">{{ $Process->SectionC[4] ?? '' }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-header">
            <h3 class="card-title">Data Storage or Disposal</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="SectionD">
                <div class="form-group">
                    <label for="SectionD">Retention period</label>
                    <textarea type="text" class="form-control" row="2" name="SectionD[]">{{ $Process->SectionD[0] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SectionD">Location of data/how stored</label>
                    <textarea type="text" class="form-control" row="2" name="SectionD[]">{{ $Process->SectionD[1] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SectionD">Is personal data being destroyed?</label>
                    <textarea type="text" class="form-control" row="2" name="SectionD[]">{{ $Process->SectionD[2] ?? '' }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="d-flex">
        <div class="p-2">
            <button type="submit" class="btn btn-secondary" name="Button" value="Back">Back</button>
        </div>
        <div class="ml-auto p-2">
            <button type="submit" class="btn btn-primary" name="Button" value="Next">Next</button>
        </div>
    </div>
</form>

<script>
    const addButton = document.querySelector("#add");
    const inputContainer = document.querySelector("#inp-group");
    const inputs = []; // Array to store the dynamically created inputs
    const dataCollected = document.querySelector('#dataCollected');

    var counter = 1;

    function removeInput() {
        const parent = this.parentElement;
        const index = inputs.indexOf(parent);

        if (index > -1) {
            inputs.splice(index, 1); // Remove the input from the array
        }

        parent.remove();
    }

    function addInput() {
        //const inputName = 'data' + counter;

        const data = document.createElement("input");
        data.className = "form-control";
        data.type = "text";
        data.placeholder = "Enter data";
        data.name = "Datacollected[]";

        const btn = document.createElement("span");
        btn.className = "btn btn-danger";
        btn.innerHTML = "Remove";
        btn.addEventListener("click", removeInput);

        const flex = document.createElement("div");
        flex.className = "input-group mb-3";

        inputContainer.appendChild(flex);
        flex.appendChild(data);
        flex.appendChild(btn);

        //inputs.push(data);
        //counter++;
    }
    addButton.addEventListener("click", addInput);
</script>
@stop
