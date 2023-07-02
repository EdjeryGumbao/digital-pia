@extends('layouts.sidebar_layout')

@section('title', 'A. Process')

@section('content')

<form action="proceed_to_risk_assessment" method="post">
    @csrf
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Process</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Process Name:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Data Subject:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Form used:</label>
                    <input type="text" class="form-control">
                    <form id="addDataField">
                        <label for="exampleInputEmail1">Data Fields:</label>
                        <div id="inp-group"></div>
                        <button id="add" type="button" class="btn btn-secondary">Add Data field</button>
                        <input type="hidden" id="dataCollected" name="dataCollected">
                    </form>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Purpose/s for Processing:</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Security Measure/s:</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Process Narrative:</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
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
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Data Source:</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Collection Method:</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Timing of Collection:</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-header">
            <h3 class="card-title">Data Use</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Is the data being used as is, or does it undergo further processing?</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Is there automated decision-making?</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-header">
            <h3 class="card-title">Data Disclosure</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Is data being transferred to third parties?</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Third-party recipients</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Purpose/s of the transfer to the third party?</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Is the data transfer supported by a data sharing agreement or a data outsourcing agreement?</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Is the personal data transferred outside of the Philippines? If so, where?</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                
            </div>
            <!-- /.card-body -->
            <div class="card-header">
            <h3 class="card-title">Data Storage or Disposal</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Retention period</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Location of data/how stored</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Is personal data being destroyed?</label>
                    <textarea type="text" class="form-control" id="exampleInputEmail1" row="2"></textarea>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
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
        const inputName = 'data' + counter;

        const data = document.createElement("input");
        data.className = "form-control";
        data.type = "text";
        data.placeholder = "Enter data";
        data.name = inputName;

        const btn = document.createElement("span");
        btn.className = "btn btn-danger";
        btn.innerHTML = "Remove";
        btn.addEventListener("click", removeInput);

        const flex = document.createElement("div");
        flex.className = "input-group mb-3";

        inputContainer.appendChild(flex);
        flex.appendChild(data);
        flex.appendChild(btn);

        inputs.push(data);
        counter++;
    }

    addButton.addEventListener("click", addInput);

    function submitForm() {
        const values = inputs.map(input => input.value);
        dataCollected.value = values.join(', ');

        // Your custom function logic here
        console.log('Form submission intercepted. Running custom function...');
        console.log('Collected data:', values);

        // After your custom logic, submit the form
        document.getElementById('addDataField').submit();
    }

    const form = document.getElementById('addDataField');
        form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting by default
        submitForm(); // Call your custom function
    });
</script>

@stop
