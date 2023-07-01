@extends('layouts.sidebar_layout')

@section('title', 'A. Process')

@section('content')

<p>Welcome to the Process</p>

<form action="proceed_to_risk_assessment" method="post">
    @csrf
    <div class="card-body">

        <form id="myForm">
            <div id="inp-group"></div>
            <button id="add" type="button">Add Input</button>
            <input type="hidden" id="dataCollected" name="dataCollected">
            <button type="submit">Submit</button>
        </form>
        
        <div class="form-group">
            <label>Process Name:</label>
            <input class="form-control">
        </div>
        <div class="form-group">
            <label>Data Subject:</label>
            <textarea class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Data Fields:</label>
            <textarea class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Purpose/s for Processing:</label>
            <textarea class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Security Measure/s:</label>
            <textarea class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Process Narrative: </label>
            <textarea class="form-control" rows="3"></textarea>
        </div>
    </div>

    <div class="card-body">
        <table>
            <tr>
                <th colspan="2" class="text-center">Process-level Analysis: Data Lifecycle</th>
            </tr>
            <tr>
                <th colspan="2" class="text-center">Data Collection</th>
            </tr>
            <tr>
                <td>Data Source:</td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Collection Method:</td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Timing of Collection:</td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <th colspan="2" class="text-center">Data Use</th>
            </tr>
            <tr>
                <td>Is the data being used as is, or does it undergo further processing? </td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Is there automated decision-making? </td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <th colspan="2" class="text-center">Data Disclosure</th>
            </tr>
            <tr>
                <td>Is data being transferred to third parties?</td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Third-party recipients</td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Purpose/s of the transfer to the third party?</td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Is the data transfer supported by a data sharing agreement or a data outsourcing agreement?</td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Is the personal data transferred outside of the Philippines? If so, where? </td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>

            <tr>
                <th colspan="2" class="text-center">Data Storage or Disposal</th>
            </tr>
            <tr>
                <td>Retention period</td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Location of data/how stored</td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Is personal data being destroyed?</td>
                <td><textarea class="form-control" rows="3"></textarea></td>
            </tr>
        </table>
    </div>

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
        document.getElementById('myForm').submit();
    }

    const form = document.getElementById('myForm');
        form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting by default
        submitForm(); // Call your custom function
    });
</script>

@stop
