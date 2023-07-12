@extends('layouts.sidebar_layout')

@section('title', 'Dashboard')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="img/USEP_Logo.png" alt="AdminLTELogo" height="200" width="200">
    </div>

    @if (auth()->user()->usertype == 'admin')
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $trueCount ?? 0  }}</h3>

            <p>Validated PIA</p>
          </div>
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check-circle" viewBox="-50 0 70 70">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
            </svg>
          </div>
          <a href="{{ url('pialist') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $falseCount ?? 0  }}</h3>

            <p>Non-Validated PIA</p>
          </div>
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-circle" viewBox="-50 0 70 70">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
          </div>
          <a href="{{ url('pialist') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $piaCount ?? 0  }}</h3>

            <p>Total PIA</p>
          </div>
          <div class="icon">
             <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="nav-icon bi-card-list" viewBox="-50 0 70 70">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
              </svg>
          </div>
          <a href="{{ url('pialist') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner" style="color: white;">
            <h3>{{ $riskAssessment ?? 0 }}</h3>

            <p>Total Threats/Vulnerabilities</p>
          </div>
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="nav-icon bi-exclamation-triangle" viewBox="-50 0 70 70">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
            </svg>
          </div>
          <a href="{{ url('threatlist') }}" class="small-box-footer"><span style="color: white;">More info </span><i class="fas fa-arrow-circle-right" style="color: white;"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-md-6">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Risk Assessment</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="RiskAssessmentChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;">
              <script>
                    const counts = {!! json_encode($counts) !!};
                    const labels = {!! json_encode($labels) !!};

                    const getColorByRiskRating = (riskRating) => {
                        if (riskRating == 1) return '#fafdff'; // white
                        if (riskRating >= 2 && riskRating <= 5) return '#ffffcc'; // light yellow
                        if (riskRating >= 6 && riskRating <= 8) return '#ffff99'; // yellow
                        if (riskRating == 9) return '#ffcccc'; // lighter red
                        if (riskRating >= 10 && riskRating <= 15) return '#ff9999'; // light red
                        if (riskRating >= 16) return '#ff0000'; // red
                    };

                    const backgroundColors = [
                      '#fafdff', // color for the first bar
                      '#ffffcc', // color for the second bar
                      '#ffff99', // color for the third bar
                      '#ffcccc', // color for the fourth bar
                      '#ff9999',
                      '#ff0000'
                    ];

                    const ctx = document.getElementById('RiskAssessmentChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Risk Rating',
                                data: counts,
                                backgroundColor: backgroundColors,
                                borderColor: 'rgba(0, 0, 0, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                      precision: 0, // Set precision to 0 to display integer values without decimals
                                    },
                                    title: {
                                        display: true,
                                        text: 'Total'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Risk Rating'
                                    }
                                }
                            }
                        }
                    });
                </script>
              </canvas>
            </div>
          </div>  
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-6">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Pie Chart</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 419px;" width="600" height="300" class="chartjs-render-monitor">
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var trueCount = <?php echo $trueCount; ?>;
                      var falseCount = <?php echo $falseCount; ?>;
                      var ctx = document.getElementById('pieChart').getContext('2d');
                      var chart = new Chart(ctx, {
                          type: 'pie',
                          data: {
                              labels: ['Validated', 'Non-Validated'],
                              datasets: [{
                                  data: [trueCount, falseCount],
                                  backgroundColor: ['#00ff00', '#ff0000'],
                              }]
                          },
                          options: {
                              responsive: true,
                              legend: {
                                  position: 'bottom',
                              }
                          }
                      });
                  });
              </script>
            </canvas>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    
    @elseif (auth()->user()->usertype == 'user')
    <div class="row justify-content-center">
        <div class="container text-center">
            <img src="img/USEP_Logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <h2 class="text-center">University of Southeastern Philippines</h2>
            <h2 class="text-center">PRIVACY IMPACT ASSESSMENT</h2>
        </div>
    </div>
    <div class="row justify-content-center mt-5 align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body text-center">
                    <a href="{{ url('/proceed_to_disclaimer') }}" class="btn btn-primary">Start Privacy Impact Assessment</a>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop