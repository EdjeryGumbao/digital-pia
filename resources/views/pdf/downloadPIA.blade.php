<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Welcome')</title>
    <style>
        {!! file_get_contents(public_path('dist/css/adminlte.min.css')) !!}
        table {
            page-break-inside: auto;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

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
                <h2 class="text-center">PRIVACY IMPACT ASSESSMENT</h2>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
<div class="container-fluid" style="margin-top: 250px"><br>

    @if($Process)
    <div class="row justify-content-center mt-5">
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
                                                    <li>{{ $collected }}</li>
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
                                <th colspan='2' class="text-center">{{ $ProcessQuestions->QuestionSetName ?? '[QuestionSetName Missing/Deleted]' }}</th>
                            </tr>
                            <tr>
                                @if(isset($Process->SectionA))
                                    <td><strong>{{ $ProcessQuestions->SectionATitle ?? '[SectionATitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @foreach($Process->SectionA as $item)
                                            <li> {{ $item }} </li>
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if(isset($Process->SectionB))
                                    <td><strong>{{ $ProcessQuestions->SectionBTitle ?? '[SectionBTitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @foreach($Process->SectionB as $item)
                                            <li> {{ $item }} </li>
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if(isset($Process->SectionC))
                                    <td><strong>{{ $ProcessQuestions->SectionCTitle ?? '[SectionCTitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @foreach($Process->SectionC as $item)
                                            <li> {{ $item }} </li>
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if(isset($Process->SectionD))
                                    <td><strong>{{ $ProcessQuestions->SectionDTitle ?? '[SectionDTitle Missing/Deleted]' }}</strong></td>
                                    <td>
                                        @foreach($Process->SectionD as $item)
                                            <li> {{ $item }} </li>
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
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title page-break"><strong>Risk Management</strong></h5>
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
                    <div class="row">
                        @foreach ($DataFlow as $item)
                            @if ($item->PrivacyImpactAssessmentID == session('PrivacyImpactAssessmentID'))
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 mb-4">
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
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif



</div><!-- /.container-fluid -->
    </section><br>
    <!-- /.content -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html> 
