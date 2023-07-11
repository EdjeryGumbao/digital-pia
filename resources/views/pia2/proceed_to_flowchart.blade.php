@extends('layouts.sidebar_layout')

@section('title', 'Data Flows')

@section('content')

<h3><strong>Process Data Flows</strong></h3>
<p>In this section you will submit the Process Data flow as an image(.PNG) created using a third-party software for making diagrams and charts.</p>

<p>Proceed to this <a href="https://app.diagrams.net/?src=about" class="badge badge-info">link</a> to start making the Process data flow</p>

<form action="{{ route('InsertDataFlow') }}" method="post" enctype='multipart/form-data'>
    @csrf
    <div class="form-group">
        <label for="FileName">File input</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" onchange="updateFileName(this)">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
            <div class="input-group-append">
                <button type="submit" class="input-group-text">Upload</button>
            </div>
        </div>
    </div>
</form>

@if (session('success'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif

@foreach ($errors->all() as $error)
    <p class="text-danger">{{ $error }}</p>
@endforeach

<br>
<div class="row">
    @if(isset($DataFlow))
        <h3><strong>Uploaded Image:</strong></h3>
        @foreach ($DataFlow as $image)
            @if ($image->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                <div class="col-md-4">
                    <div class="card mb-4">
                        <a href="/images/{{ $image->FileName }}" target="_blank">
                            <img src="/images/{{ $image->FileName }}" alt="{{ $image->FileName }}" class="card-img-top">
                        </a>
                        <div class="card-body">                                
                            <form action="delete_dataflow" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger" name="DataFlowID" value="{{ $image->DataFlowID }}">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div><br>

<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Toggle Description
</button>
<div class="collapse" id="collapseExample">
    <h3><strong>Description</strong></h3>
    <ul>
        <li>
            <strong>Objective:</strong> To identify information flows of personal information under assessment.
        </li><br>
        <li>
            <strong>Input:</strong> Description of the process and information system to be assessed.
        </li><br>
        <li>
            <strong>Expected output:</strong> Summary of findings on the information flow of personal information within the process.
        </li><br>
        <li>
            <strong>Actions:</strong> The person responsible for conducting a PIA should consult with others in the organization and perhaps external to the organization to describe the personal information flows and specifically:
        </li>
                <p>– how personal information is collected and the related source;
                    <br>– who is accountable and who is responsible within the organization for the personal information processing;
                    <br>– for what purpose personal information is processed;
                    <br>– how personal information will be processed;
                    <br>– personal information retention and disposal policy;
                    <br>– how personal information will be managed and modified;
                    <br>– how will personal information processors and application developers protect personal information;
                    <br>– identify any personal information transfer to jurisdictions where lower levels of personal information protection apply;
                    <br>– whether applicable, notify the relevant authorities of any new personal information processing and seek the necessary approvals.
                </p>
    </Ul>

    <p>Output of this process in terms of the information flow of personal information should be documented in the PIA report</p>

    <ul>
        <li>Implementation Guidance:</li><br>
        <p>
            Use of personal information (or transfer of personal information) may include approved data sharing flows of personal information to other parties. 
        </p>
        <p>
            As an input to the PIA, the organization should describe the information flow in as detailed a manner as possible to help identify potential privacy risks. The assessor should consider the impacts not only on information privacy, privacy related regulations, e.g. telecommunications acts. The whole personal information life cycle should be considered.
        </p>
    </ul>

    <p><em>Identify the personal data involved and describe the data flow from collection to disposal by answering the following questions below:</em></p>
    <ul>
        <p><strong>What personal data are being or will be processed by this project/system?</strong></p>
        <ul>
            <p>List all personal data (e.g. Personal Full Name, address, gender, phone number, etc.,) and state which is/are the sensitive personal information (e.g. race, ethnicity, marital status, health, genetic, government issued numbers).</p>
        </ul>

        <p><strong>All the information stated above will be in accordance to the next section.</strong></p>

        <ul>
            <h5><strong>Collection</strong></h5>
            <ol>
                <li>State who collected or will be collecting the personal information and/or sensitive information.</li>
                <li>How the personal information/sensitive personal information is collected and from whom it was collected?</li>
                <ul>
                    <li><em>If personal information is collected from some source other than the individual?</em></li>
                </ul>
                <li>What is/are the purpose(s) of collecting the personal data?</li>
                <ul>
                    <li><em>Be clear about the purpose of collecting the information</em></li>
                    <li><em>Are you collecting what you only need?</em></li>
                </ul>
                <li>How was or will the consent be obtained?</li>
                <ul>
                    <li><em>Do individuals have the opportunity and/or right to decline to provide data?</em></li>
                    <li><em>What happen if they decline?</em></li>
                </ul>
            </ol>
            
            <h5><strong>Storage</strong></h5>
            <ol>
                <li>Where is it currently being stored?</li>
                <ul>
                    <li><em>Is it being stored in a physical server or in the cloud?</em></li>
                </ul>
                <li>Is it being stored in other country</li>
                <ul>
                    <li><em>If it is subject to a cross-border transfer, specify what country or countries.</em></li>
                </ul>
                <li>Is the storage of data being outsourced?</li>
                <ul>
                    <li><em>Specify if the storing process is being done in-house or is it handled by a service provider</em></li>
                </ul>
            </ol>

            <h5><strong>Usage</strong></h5>
            <ol>
                <li>How will the data being used or what is the purpose of its processing?</li>
                <ul>
                    <li><em>Describe how the collected information is being used or will be used</em></li>
                    <li><em>Specify the processing activities where the personal information is being used.</em></li>
                </ul>
            </ol>

            
            <h5><strong>Retention</strong></h5>
            <ol>
                <li>How long are the data being retained? And Why?</li>
                <ul>
                    <li><em>State the length of period the data is being retained?</em></li>
                    <li><em>What is the basis of retaining the data that long? Specify the reason(s)</em></li>
                </ul>
                <li>How long are the data being retained? And Why?</li>
                <ul>
                    <li><em>Specify if the data retention process is being done in-house or is it handled by a service provider</em></li>
                </ul>
            </ol>

            <h5><strong>Disclosure/Sharing</strong></h5>
            <ol>
                <li>To whom it is being disclosed to?</li>
                <li>Is it being disclosed outside the organization? Why is it being disclosed?</li>
                <ul>
                    <li><em>Specify if the personal information is being shared outside the organization</em></li>
                    <li><em>What are the reasons for disclosing the personal information</em></li>
                </ul>
            </ol>

            <h5><strong>Disposal/Destruction</strong></h5>
            <ol>
                <li>How will the data be disposed?</li>
                <ul>
                    <li><em>Describe the process of disposing the personal information</em></li>
                </ul>
                <li>Who will facilitate the destruction of the data?</li>
                <ul>
                    <li><em>State if the process is being managed in-house or if it is a third party</em></li>
                </ul>
            </ol>
        </ul>
    </ul>
</div><br>

<p>Please use this sample diagram as a reference:</p>
<a href="/images/{{ $image->FileName }}" target="_blank">
    <img src="img/plow.png" alt="Sample Data Flow" width="600" height="300">
</a>



<div class="d-flex">
    <div class="p-2">
        <form action="proceed_to_risk_assessment" method="post">
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
    function updateFileName(input) {
        var fileName = input.files[0].name;
        var label = input.nextElementSibling;
        label.textContent = fileName;
    }
</script>

@stop
