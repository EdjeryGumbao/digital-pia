@extends('layouts.sidebar_layout')

@section('title', 'A. Process')

@section('content')


@foreach ($errors->all() as $error)
    <p class="text-danger">{{ $error }}</p>
@endforeach


<form action="InsertProcess" method="post" id="processForm">
    
    <h3><strong>Process Description:</strong></h3>
    <p>Describe the process and its context. Define and specify what it intends to achieve. Fill in the form below to help you describe the process</p>

    @csrf
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Process</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label for="DataSubject">Data Subject/s:</label>
                    <input type="text" class="form-control" name="DataSubject" value="{{ $Process->DataSubject ?? ''}}" >
                </div>
                <div class="form-group">
                    <label for="FormUsed">Data Collection Form Name:</label>
                    <p>Note: This is the form used to collect Personal Data</p>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="FormUsed">
                </div>
                <div class="form-group">
                    <label for="Datacollected[]">Data Fields:</label>
                    <div id="inp-group"></div>
                    <button id="add" type="button" class="btn btn-success">Add Data field</button>
                    <button type="submit" class="btn btn-primary" name="Button" value="FormData">Save</button>
                </div>

                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                        <tbody>
                            @if(isset($DataFields))
                                @foreach ($DataFields as $item)
                                    @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                                        <tr>
                                            <td>
                                                <strong>{{ $item->FormUsed }}:</strong>
                                            </td>
                                            <td>
                                                @if ($item->Datacollected)
                                                    {{ implode(', ', $item->Datacollected) }}
                                                @endif
                                            </td>
                                            <td class="d-flex flex-row-reverse">
                                                <div class="d-flex flex-row-reverse">
                                                    <div class="p-2">
                                                        <button type="submit" class="btn btn-danger" name="delete_datafield" value="{{ $item->DataFieldsID }}" onclick="return confirmDelete()">Delete</button>
                                                    </div>
                                                    <div class="p-2">
                                                        <button type="submit" class="btn btn-primary" name="edit_datafield" value="{{ $item->DataFieldsID }}">Edit</button>
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
                    <textarea type="text" class="form-control" name="PurposeforProcessing" row="2" style="white-space: pre-line;">{{ $Process->PurposeforProcessing ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="SecurityMeasure">Security Measure/s:</label>
                    <textarea type="text" class="form-control" name="SecurityMeasure" row="2" style="white-space: pre-line;">{{ $Process->SecurityMeasure ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <tr>
                        <td class="text-nowrap">
                            <label for="ProcessNarrative"><strong>Process Narrative:</strong></label>
                        </td>
                    <tr>
                        <td>
                            <div id="ProcessNarrativeContainer">
                            @if(isset($Process->ProcessNarrative))
                                @foreach ($Process->ProcessNarrative as $item) 
                                <div class="input-group mb-2">
                                    <input class="form-control" type="text" placeholder="Enter process" name="ProcessNarrative[]" value="{{ $item }}">
                                    <span class="btn btn-danger" onclick="removeProcess(this)">Remove</span>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        </td>
                        <td><button id="addProcessNarrative" type="button" class="btn btn-success">Add Process</button></td>
                    </tr>

                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    
    <h3><strong>{{ $ProcessQuestions->QuestionSetName ?? '' }}</strong></h3>
    <p>
        Each process or means for collecting personal information should be tested for consistency with the following Data Privacy 
        Principles (as identified in Rule IV, Implementing Rules, and Regulations of Republic Act No. 10173, known as the “Data Privacy 
        Act of 2012”). Respond accordingly by answering the following questions in the form below.  
    </p>

    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">{{ $ProcessQuestions->SectionATitle ?? '' }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="SectionA">
                @php $count = 0; @endphp
                @foreach($ProcessQuestions->SectionAQuestions as $item)
                <div class="form-group">
                    <label for="SectionA">{{ $item }}</label>
                    <textarea type="text" class="form-control" row="2" name="SectionA[]" style="white-space: pre-line;">{{ $Process->SectionA[$count] ?? '' }}</textarea>
                </div>
                @php $count++; @endphp
                @endforeach
            </div>
            <!-- /.card-body -->
            <div class="card-header">
            <h3 class="card-title">{{ $ProcessQuestions->SectionBTitle ?? '' }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="SectionB">
                @php $count = 0; @endphp
                @foreach($ProcessQuestions->SectionBQuestions as $item)
                <div class="form-group">
                    <label for="SectionB">{{ $item }}</label>
                    <textarea type="text" class="form-control" row="2" name="SectionB[]" style="white-space: pre-line;">{{ $Process->SectionB[$count] ?? '' }}</textarea>
                </div>
                @php $count++; @endphp
                @endforeach
            </div>
            <!-- /.card-body -->
            <div class="card-header">
            <h3 class="card-title">{{ $ProcessQuestions->SectionCTitle ?? '' }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="SectionC">
                @php $count = 0; @endphp
                @foreach($ProcessQuestions->SectionCQuestions as $item)
                <div class="form-group">
                    <label for="SectionC">{{ $item }}</label>
                    <textarea type="text" class="form-control" row="2" name="SectionC[]" style="white-space: pre-line;">{{ $Process->SectionC[$count] ?? '' }}</textarea>
                </div>
                @php $count++; @endphp
                @endforeach
            </div>
            <!-- /.card-body -->
            <div class="card-header">
            <h3 class="card-title">{{ $ProcessQuestions->SectionDTitle ?? '' }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="SectionD">
                @php $count = 0; @endphp
                @foreach($ProcessQuestions->SectionDQuestions as $item)
                <div class="form-group">
                    <label for="SectionD">{{ $item }}</label>
                    <textarea type="text" class="form-control" row="2" name="SectionD[]" style="white-space: pre-line;">{{ $Process->SectionD[$count] ?? '' }}</textarea>
                </div>
                @php $count++; @endphp
                @endforeach
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


    
    const addProcessNarrative = document.querySelector("#addProcessNarrative");

    const ProcessNarrativeContainer = document.querySelector("#ProcessNarrativeContainer");

    // Array to store the dynamically created inputs
    const ProcessNarrativeContainerInputs = [];

    // ProcessNarrative
    function addProcessNarrativeInput() {
        const data = document.createElement("input");
        data.className = "form-control";
        data.type = "text";
        data.placeholder = "Enter process";
        data.name = "ProcessNarrative[]";

        const btn = document.createElement("span");
        btn.className = "btn btn-danger";
        btn.innerHTML = "Remove";
        btn.addEventListener("click", removeProcessNarrative);

        const flex = document.createElement("div");
        flex.className = "input-group mb-2";

        ProcessNarrativeContainer.appendChild(flex);
        flex.appendChild(data);
        flex.appendChild(btn);
    }

    function removeProcessNarrative() {
        const parent = this.parentElement;
        const index = ProcessNarrativeContainerInputs.indexOf(parent);
        if (index > -1) {
            ProcessNarrativeContainerInputs.splice(index, 1); // Remove the input from the array
        }
        parent.remove();
    }

    function removeProcess(element) {
        const parentElement = element.parentNode;
        parentElement.parentNode.removeChild(parentElement);
    }

    addProcessNarrative.addEventListener("click", addProcessNarrativeInput);

    function confirmDelete() {
        // Show a pop-up dialog with a confirmation message
        const confirmation = confirm("Are you sure you want to delete this? This action cannot be undone.");

        // If the user clicks "OK," the form will be submitted; otherwise, the deletion process will be canceled.
        return confirmation;
    }
</script>
@stop
