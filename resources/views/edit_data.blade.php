@extends('layouts.sidebar_layout')

@section('title', 'Data Field Edit')

@section('content')
    
<div class="card card-primary">
    <div class="card-body">
        <form action="edit_data" method="post" id="processForm">
            @csrf
            <div class="form-group">
                <label for="FormUsed">Data Collection Form Name:</label>
                <p>Note: This is the form used to collect Personal Data</p>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="FormUsed" value="{{ $DataFields->FormUsed }}">
            </div>
            <div class="form-group">
                <label for="Datacollected[]">Data Fields:</label>
                <div id="inp-group">
                    @foreach ($DataFields->Datacollected as $item)
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" placeholder="Enter data" name="Datacollected[]" value="{{ $item }}">
                            <span class="btn btn-danger" onclick="return removeDataInput(this)">Remove</span>
                        </div>
                    @endforeach
                </div>
                <button id="add" type="button" class="btn btn-success">Add Data field</button>
                <button type="submit" class="btn btn-primary" name="DataFieldsID" value="{{ $DataFields->DataFieldsID }}">Save</button>
            </div>
        </form>
    </div>
</div>

@foreach ($errors->all() as $error)
    <p class="text-danger">{{ $error }}</p>
@endforeach

<script>
    const addButton = document.querySelector("#add");
    const inputContainer = document.querySelector("#inp-group");
    const dataCollected = document.querySelector('#dataCollected');

    var counter = 1;

    function removeInput() {
        const parent = this.parentElement;
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

    function confirmDelete() {
        // Show a pop-up dialog with a confirmation message
        const confirmation = confirm("Are you sure you want to delete this? This action cannot be undone.");

        // If the user clicks "OK," the form will be submitted; otherwise, the deletion process will be canceled.
        return confirmation;
    }

    function removeDataInput(buttonElement) {
        const parentNode = buttonElement.parentElement;
        parentNode.remove();
    }
</script>
@stop