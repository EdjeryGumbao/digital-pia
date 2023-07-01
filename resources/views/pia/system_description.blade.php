@extends('layouts.sidebar_layout')

@section('title', 'Project/System Description')

@section('content')
    <p>Welcome to the Project/System Description!</p>

    <p>
        <strong>a. Description</strong><br>
        Describe the program, project, process, measure, system or technology product and its context. <br>
        Define and specify what it intends to achieve. Consider the pointers below to help you describe the project. 
    </p>

    <ul>
        <li>
            <strong>Brief Description of the project/system:</strong>
            <ul>
            <li>Describe the process of the project.</li>
            <li>Describe the scope and extent.</li>
            <li>Any links with existing programs or other projects.</li>
            </ul>
        </li>
        <li>
            <strong>The system/project’s overall aims (purpose of the project/system):</strong>
            <ul>
            <li>What is the project/system aiming to achieve?</li>
            <li>What are the benefits for the organizations and data subjects?</li>
            </ul>
        </li>
        <li>
            <strong>Any related documents to support the projects/system:</strong>
            <ul>
            <li>Project/System Requirements Specification</li>
            <li>Project/System Design Specification</li>
            <li>Or any related documents.</li>
            </ul>
        </li>
    </ul>

    <p>
        <strong>b. Scope of the PIA</strong><br>
        This section should explain, what part or phase of the program the PIA covers and, where necessary for clarity, what it does not cover.
    </p>
    <ul>
        <li>What will the PIA cover?</li>
        <li>What areas are outside scope?</li>
        <li>Is this just a "desk-top" information gathering exercise, do I have to get information from a wide variety of sources?</li>
        <li>Who needs to be involved and when will they be available?</li>
        <li>Where does the PIA need to fit in the overall project plan and timelines?</li>
        <li>Who will make decisions about the issues identified by the PIA? What information do they need, and how long will it take to get sign-off from them?</li>
        <li>Do I need to consult with anyone (for instance, the individuals whose personal information the project will involve)? When and how should this happen?</li>
        <li>Are there any third parties involved and how long do I need to allow for them to play their part?</li>
    </ul>

    <p>
        <em>By clicking the <strong>"I Understand"</strong> button, you agree to give permission for the use of the information you provide to support the project/system's objectives.  Rest assured that your data will be handled responsibly and treated with utmost confidentiality.</em>
    </p>

<form action="proceed_to_threshold_analysis" method="post">
  @csrf
  <button type="submit" class="btn btn-primary" value="1" name="value">I Understand</button>
</form>



@stop