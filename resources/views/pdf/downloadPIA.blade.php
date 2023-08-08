<!DOCTYPE html>
<html lang="en">

 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $PrivacyImpactAssessment->ProcessName ?? '' }}</title>


    <!-- 
        table {
            page-break-inside: auto;
        }

        .page-break {
            page-break-before: always;
        }
        
        {!! file_get_contents(public_path('dist/css/adminlte.min.css')) !!}

    -->
    <style>
            {!! file_get_contents(public_path('css/pdf.css')) !!}
    </style> 
</head>


<body>
<div class="wrapper">
    @if ($PrivacyImpactAssessment->Status == 'Validated')
    <div class="validation-box">
        <div class="validation-label">OLA-UDPO VALIDATED</div>
        <div class="validation-date">Date Validated: {{ (new DateTime($PrivacyImpactAssessment->DateValidated))->format('F d, Y') }}</div>
    </div>
    @endif
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="container text-center" style="margin-top: 100px">
                <?php
                    $imagePath = public_path('img/USEP_Logo.png');
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $imageSrc = 'data:image/png;base64,' . $imageData;
                ?>

                <img src="{{ $imageSrc }}" class="brand-image img-circle elevation-3" style="opacity: .8"><br><br>
                <h2 class="text-center">University of Southeastern Philippines</h2>
                <h2 class="text-center">PRIVACY IMPACT ASSESSMENT</h2><br><br>
                <h3 class="text-center">{{ $PrivacyImpactAssessment->Department ?? ''}}</h3>
                <h5 class="text-center">Prepared by:</h5>
                <h3 class="text-center">{{ $PrivacyImpactAssessment->Author ?? ''}}</h3>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
<div class="container-fluid" style="margin-top: 250px"><br>

    @if($Process)
    <div class="row justify-content-center mt-5 page-break">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Process Information</strong></h5><br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="text-nowrap" width="200px"><strong>Process Name:</strong></td>
                                <td>{{ $PrivacyImpactAssessment->ProcessName ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Data Subject:</strong></td>
                                <td>{{ $Process->DataSubject }}</td>
                            </tr>
                            <tr>
                                <td><strong>Data Fields:</strong></td>
                                <td>
                                    @if(isset($DataFields))
                                        @foreach ($DataFields as $item)
                                            @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                                            <li>{{ $item->FormUsed }}</li>
                                            <ul>
                                                @foreach ($item->Datacollected as $collected)
                                                    @if (isset($collected))
                                                        <li>{{ $collected }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>   
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Purpose for Processing:</strong></td>
                                <td>{{ $Process->PurposeforProcessing }}</td>
                            </tr>
                            <tr>
                                <td><strong>Security Measure:</strong></td>
                                <td>{{ $Process->SecurityMeasure }}</td>
                            </tr>
                            <tr>
                                <td><strong>Process Narrative:</strong></td>
                                <td>
                                    <ol style="padding-left: 0; page-break-inside: auto">
                                    @if (isset($Process->ProcessNarrative))
                                        @foreach ($Process->ProcessNarrative as $item) 
                                            <li style="margin-left: 14px;  ">{{ $item }}</li>
                                        @endforeach
                                    @endif
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <th colspan='2' class="text-center"><h3>{{ $ProcessQuestions->QuestionSetName ?? '[QuestionSetName Missing/Deleted]' }}</h3></th>
                            </tr>
                            <tr>
                                @if(isset($Process->SectionA))
                                    <td><strong>{{ $ProcessQuestions->SectionATitle ?? '[SectionATitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @php
                                        // Combine the two arrays using array_map
                                        $combinedArray = array_map(null, $Process->SectionA, $ProcessQuestions->SectionAQuestions);
                                        @endphp

                                        @foreach($combinedArray as $index => [$item, $item2])
                                            <p><strong> {{ $item2 }} </strong></p>
                                            @if (isset($item))
                                                <li> {{ $item }} </li>
                                            @elseif (isset($item) == null)
                                                <li> N/A </li>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if(isset($Process->SectionB))
                                    <td><strong>{{ $ProcessQuestions->SectionBTitle ?? '[SectionBTitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @php
                                        // Combine the two arrays using array_map
                                        $combinedArray = array_map(null, $Process->SectionB, $ProcessQuestions->SectionBQuestions);
                                        @endphp

                                        @foreach($combinedArray as $index => [$item, $item2])
                                            <p><strong> {{ $item2 }} </strong></p>
                                            @if (isset($item))
                                                <li> {{ $item }} </li>
                                            @elseif (isset($item) == null)
                                                <li> N/A </li>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if(isset($Process->SectionC))
                                    <td><strong>{{ $ProcessQuestions->SectionCTitle ?? '[SectionCTitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @php
                                        // Combine the two arrays using array_map
                                        $combinedArray = array_map(null, $Process->SectionC, $ProcessQuestions->SectionCQuestions);
                                        @endphp

                                        @foreach($combinedArray as $index => [$item, $item2])
                                            <p><strong> {{ $item2 }} </strong></p>
                                            @if (isset($item))
                                                <li> {{ $item }} </li>
                                            @elseif (isset($item) == null)
                                                <li> N/A </li>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if(isset($Process->SectionD))
                                    <td><strong>{{ $ProcessQuestions->SectionDTitle ?? '[SectionDTitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @php
                                        // Combine the two arrays using array_map
                                        $combinedArray = array_map(null, $Process->SectionD, $ProcessQuestions->SectionDQuestions);
                                        @endphp

                                        @foreach($combinedArray as $index => [$item, $item2])
                                            <p><strong> {{ $item2 }} </strong></p>
                                            @if (isset($item))
                                                <li> {{ $item }} </li>
                                            @elseif (isset($item) == null)
                                                <li> N/A </li>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($RiskAssessment)
    <div class="row justify-content-center mt-5 page-break">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Risk Management</strong></h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Threat/Vulnerability</th>
                                <th>Impact</th>
                                <th>Probability</th>
                                <th>Risk Rating</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                    @endif">
                                    {{ $item->RiskRating }}
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($DataFlow)
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Data Flow</strong></h5><br><br>
                    @foreach ($DataFlow as $item)
                        @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="card">  
                                    <?php
                                        $imagePath = public_path('images/' . $item->FileName);
                                        $imageData = base64_encode(file_get_contents($imagePath));
                                        $imageSrc = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
                                    ?>

                                    <img src="{{ $imageSrc }}" class="card-img-top img-fluid">

                                </div>  
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($Recommendation)
    <div class="row justify-content-center mt-5 page-break">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Recommended Solution/s</strong></h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Recommendation</th>
                                <th>Priority</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Recommendation as $item)
                            @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                            <tr>
                                <td>{{ $item->Recommendation }}</td>
                                <td>{{ $item->Priority }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($PrivacyImpactAssessment->Status == 'Validated')
    <div class="page-break">
        <?php
            $imagePath = public_path('pdf/1DPC_UAGC_Manual1024_1.png');
            $imageData = base64_encode(file_get_contents($imagePath));
            $imageSrc = 'data:image/png;base64,' . $imageData;
        ?>

        <img src="{{ $imageSrc }}">
    </div>
    @endif


</div><!-- /.container-fluid -->
    </section><br>
    <!-- /.content -->

</div>
<!-- ./wrapper -->

</body>
</html> 
