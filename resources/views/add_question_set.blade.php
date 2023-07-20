@extends('layouts.sidebar_layout')

@section('title', 'Add Question Set')

@section('content')

@foreach ($errors->all() as $error)
    <p class="text-danger">{{ $error }}</p>
@endforeach

<form action="InsertProcessQuestion" method="post">
    @csrf
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Questions</strong></h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="text-nowrap" width="80px">
                                        <label for="QuestionSetName"><strong>Question Set Name:</strong></label>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="QuestionSetName">
                                    </td>
                                </tr>
                            <tr> <!-- Section A -->
                                <td class="text-nowrap">
                                    <label for="SectionATitle"><strong>Section A Title:</strong></label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="SectionATitle">
                                </td>
                            <tr>
                                <td><button id="addSectionA" type="button" class="btn btn-success">Add Data field</button></td>
                                <td><div id="sectionAContainer"></div></td>
                            </tr> <!-- Section A -->

                            <tr> <!-- Section B -->
                                <td class="text-nowrap">
                                    <label for="SectionBTitle"><strong>Section B Title:</strong></label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="SectionBTitle">
                                </td>
                            <tr>
                                <td><button id="addSectionB" type="button" class="btn btn-success">Add Data field</button></td>
                                <td><div id="sectionBContainer"></div></td>
                            </tr> <!-- Section B -->

                            <tr> <!-- Section C -->
                                <td class="text-nowrap">
                                    <label for="SectionCTitle"><strong>Section C Title:</strong></label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="SectionCTitle">
                                </td>
                            <tr>
                                <td><button id="addSectionC" type="button" class="btn btn-success">Add Data field</button></td>
                                <td><div id="sectionCContainer"></div></td>
                            </tr> <!-- Section C -->

                            <tr> <!-- Section D -->
                                <td class="text-nowrap">
                                    <label for="SectionDTitle"><strong>Section D Title:</strong></label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="SectionDTitle">
                                </td>
                            <tr>
                                <td><button id="addSectionD" type="button" class="btn btn-success">Add Data field</button></td>
                                <td><div id="sectionDContainer"></div></td>
                            </tr> <!-- Section D -->
                            <tr>
                                <td></td> 
                                <td>
                                    <div class="d-flex flex-row-reverse">
                                        <div class="p-2">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    const addSectionA = document.querySelector("#addSectionA");
    const addSectionB = document.querySelector("#addSectionB");
    const addSectionC = document.querySelector("#addSectionC");
    const addSectionD = document.querySelector("#addSectionD");

    const sectionAContainer = document.querySelector("#sectionAContainer");
    const sectionBContainer = document.querySelector("#sectionBContainer");
    const sectionCContainer = document.querySelector("#sectionCContainer");
    const sectionDContainer = document.querySelector("#sectionDContainer");

    // Array to store the dynamically created inputs
    const sectionAInputs = [];
    const sectionBInputs = [];
    const sectionCInputs = [];
    const sectionDInputs = [];

    // start of section A
    function addSectionAInput() {
        const data = document.createElement("input");
        data.className = "form-control";
        data.type = "text";
        data.placeholder = "Enter data";
        data.name = "SectionAQuestions[]";

        const btn = document.createElement("span");
        btn.className = "btn btn-danger";
        btn.innerHTML = "Remove";
        btn.addEventListener("click", removeSectionAInputs);

        const flex = document.createElement("div");
        flex.className = "input-group mb-2";

        sectionAContainer.appendChild(flex);
        flex.appendChild(data);
        flex.appendChild(btn);
    }

    function removeSectionAInputs() {
        const parent = this.parentElement;
        const index = sectionAInputs.indexOf(parent);
        if (index > -1) {
            sectionAInputs.splice(index, 1); // Remove the input from the array
        }
        parent.remove();
    }
    // end of section A

    // start of section B  
    function addSectionBInput() {
        const data = document.createElement("input");
        data.className = "form-control";
        data.type = "text";
        data.placeholder = "Enter data";
        data.name = "SectionBQuestions[]";

        const btn = document.createElement("span");
        btn.className = "btn btn-danger";
        btn.innerHTML = "Remove";
        btn.addEventListener("click", removeSectionBInputs);

        const flex = document.createElement("div");
        flex.className = "input-group mb-2";

        sectionBContainer.appendChild(flex);
        flex.appendChild(data);
        flex.appendChild(btn);
    }

    function removeSectionBInputs() {
        const parent = this.parentElement;
        const index = sectionBInputs.indexOf(parent);
        if (index > -1) {
            sectionBInputs.splice(index, 1); // Remove the input from the array
        }
        parent.remove();
    }
    // end of section B

    // start of section C
    function addSectionCInput() {
        const data = document.createElement("input");
        data.className = "form-control";
        data.type = "text";
        data.placeholder = "Enter data";
        data.name = "SectionCQuestions[]";

        const btn = document.createElement("span");
        btn.className = "btn btn-danger";
        btn.innerHTML = "Remove";
        btn.addEventListener("click", removeSectionCInputs);

        const flex = document.createElement("div");
        flex.className = "input-group mb-2";

        sectionCContainer.appendChild(flex);
        flex.appendChild(data);
        flex.appendChild(btn);
    }

    function removeSectionCInputs() {
        const parent = this.parentElement;
        const index = sectionCInputs.indexOf(parent);
        if (index > -1) {
            sectionCInputs.splice(index, 1); // Remove the input from the array
        }
        parent.remove();
    }
    // end of section C

    // start of section D
    function addSectionDInput() {
        const data = document.createElement("input");
        data.className = "form-control";
        data.type = "text";
        data.placeholder = "Enter data";
        data.name = "SectionDQuestions[]";

        const btn = document.createElement("span");
        btn.className = "btn btn-danger";
        btn.innerHTML = "Remove";
        btn.addEventListener("click", removeSectionDInputs);

        const flex = document.createElement("div");
        flex.className = "input-group mb-2";

        sectionDContainer.appendChild(flex);
        flex.appendChild(data);
        flex.appendChild(btn);
    }

    function removeSectionDInputs() {
        const parent = this.parentElement;
        const index = sectionDInputs.indexOf(parent);
        if (index > -1) {
            sectionDInputs.splice(index, 1); // Remove the input from the array
        }
        parent.remove();
    }
    // end of section D

    addSectionA.addEventListener("click", addSectionAInput);
    addSectionB.addEventListener("click", addSectionBInput);
    addSectionC.addEventListener("click", addSectionCInput);
    addSectionD.addEventListener("click", addSectionDInput);
</script>
@stop