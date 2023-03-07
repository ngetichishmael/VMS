@extends('layouts.contentLayoutMaster')

@section('title', 'MOJA PASS')

@section('vendor-style')
    {{-- vendorcssfiles --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('fonts/font-awesome/css/font-awesome.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/jstree.min.css')) }}">
@endsection
@section('page-style')
    {{-- Pagecssfiles --}}

    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-tree.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <!-- Medal Card -->

            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal"
                    style=" background: linear-gradient(to right, #15807A, rgb(111,178,190))">
                    <div class="card-body">

                        <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">VISITS TODAY</p>
                        <div class="media">
                            <div class="avatar bg-light-primary mr-2">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="users" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr />
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $maleCount}}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Male &nbsp; {!! $percentage_male !!}%</p>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $maleCount }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Female &nbsp; {!! $percentage_female !!}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal"
                    style=" background: linear-gradient(to right, #792e07, #ff8b4e)">
                    <div class="card-body">
                        <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">Gender Comparison Last Week</p>
                        <div class="media">
                            <div class="avatar bg-light-primary mr-2">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="sunset" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr />
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $totalMaleLastWeek }}
                                </h4>
                                <hr style="color: #bebbbb" />
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Male</p>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $totalFemaleLastWeek }}
                                </h4>
                                <hr style="color: #bebbbb" />
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Female</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="col-xl-4 col-md-6 col-12">--}}
{{--                <div class="card card-congratulation-medal"--}}
{{--                     style=" background: linear-gradient(to right, #043331, #08dad1)">--}}
{{--                    <div class="card-body">--}}
{{--                        <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">Motor Vehicle Count</p>--}}
{{--                        <div class="media">--}}
{{--                            <div class="avatar bg-light-primary mr-2">--}}
{{--                                <div class="avatar-content" style="background: whitesmoke">--}}
{{--                                    <i data-feather="building" class="avatar-icon"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <hr />--}}
{{--                            <div class="media-body my-auto">--}}
{{--                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $totalVehicleWeek }}</h4>--}}
{{--                                <hr style="color: #bebbbb" />--}}
{{--                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">This Week</p>--}}
{{--                            </div>--}}
{{--                            <div class="media-body my-auto">--}}
{{--                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $totalLastVehicleVisit }}--}}
{{--                                </h4>--}}
{{--                                <hr style="color: #bebbbb" />--}}
{{--                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Last Week</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal"
                     style=" background: linear-gradient(to right, #e75f04, #fdc39b)">
                    <div class="card-body">
                        <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">Weekly Visits</p>
                        <div class="media">
                            <div class="avatar bg-light-primary mr-2">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="calendar" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr />
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $totalThisWeek }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">This Week</p>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $totalLastWeekVisit }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Last Week</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal"
                     style=" background: linear-gradient(to right, #0b5777, #69adcb)">
                    <div class="card-body">
                        <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">CHECK-IN THIS WEEK</p>
                        <div class="media">
                            <div class="avatar bg-light-primary mr-2">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="badge" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr />
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $ipass }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">IPass check-in</p>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $sms }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">SMS Check-in</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal"
                     style=" background: linear-gradient(to right, #295922, #94ee88)">
                    <div class="card-body">
                        <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">AUTOMATIC CHECK-IN THIS WEEK</p>
                        <div class="media">
                            <div class="avatar bg-light-primary mr-2">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="QR_CODE" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr />
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $drivein }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Drive-in</p>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $walkin }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Walk-in</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="chartjs-chart">
        <div class="row">
            <!-- Horizontal Bar Chart Start -->
            <div class="col-xl-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                        <div class="header-left">
                            <p class="card-subtitle text-muted mb-25">{!! ucwords("Monthly Visits by Gender") !!}</p>
                            <h4 class="card-title">{!! ucwords("Monthly Visits by Gender") !!}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="monthly-visits" class="chartjs" data-height="400"></canvas>
                    </div>
                    <div class="header-right d-flex align-items-center pl-2">
                        <div class="d-flex align-items-center">
                            <span class="bullet bullet-primary"></span>
                            <h6 class="mb-0 ml-50">{{ $maleMonthlyVisitorCount }} MALE</h6>
                        </div>
                        <div class="d-flex align-items-center ml-75">
                            <span class="bullet bullet-danger"></span>
                            <h6 class="mb-0 ml-50">{{ $femaleMonthlyVisitorCount }} FEMALE</h6>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var BarChart = {!! $BarChart !!};
                    var ctx = document.getElementById('monthly-visits').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: BarChart,
                        options: {
                            responsive:true,
                            title:'MONTHLY VISITS',
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                });

            </script>
            <!-- Horizontal Bar Chart End -->
                <div class="col-xl-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-subtitle text-muted mb-25">{!! ucwords("Monthly Visits by Gender") !!}</p>
                            <h4 class="card-title">{!! ucwords("Monthly Visits by Gender") !!}</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="monthly-visitors-by-age1" height="274"></canvas>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        var monthlyData = {
                            labels: {!! json_encode($labelschart) !!},
                            datasets: [
                                {
                                    data: {!! json_encode($datachart) !!},
                                    backgroundColor: [
                                        "#FF6384",
                                        "#36A2EB",
                                        "#FFCE56",
                                        "#1ABC9C",
                                        "#F1C40F",
                                        "#9B59B6",
                                        "#E74C3C",
                                        "#2ECC71",
                                        "#34495E",
                                        "#3498DB"
                                    ]
                                }]
                        };

                        var ctx = document.getElementById('monthly-visitors-by-age1').getContext('2d');
                        var myPieChart = new Chart(ctx, {
                            type: 'pie',
                            data: monthlyData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                            }
                        });
                    });
                </script>

            </div>
        <div>
            <div class="card">
            <canvas id="myChart" height="300px"></canvas>
            <div class="header-right d-flex align-items-center pl-2">
                <div>
                    <p class="card-text mb-0 pl-4 pb-5">TOTAL VISITORS : {{ $totalVisitors}}</p>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script type="text/javascript">

                var labels =  {!! $vlabels !!};
                var users =  {!! $vdata !!};

                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'VISITORS MONTHLY GRAPH LINE',
                        backgroundColor: 'rgb(82,179,220)',
                        borderColor: 'rgb(133,210,243)',
                        data: users,
                    }]
                };

                const config = {
                    type: 'line',
                    data: data,
                    options: {}
                };

                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );

            </script>
        </div>
    </div>
       <div class="card">
           <div class="col-xl-6 col-12">
               <div class="card">
                   <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                       <div class="header-left">
                           <p class="card-subtitle text-muted mb-25">Yearly Visitors</p>
                           <h4 class="card-title">Visits</h4>
                       </div>
                   </div>
                   <div class="card-body">
                       <canvas id="yearly-visitors" class="chartjs" data-height="400"></canvas>
                   </div>
               </div>
           </div>

           <script>
               $(document).ready(function() {
               var yearlyData = {!! $yearlyData !!};
               var ctx = document.getElementById('yearly-visitors').getContext('2d');
               var myChart = new Chart(ctx, {
                   type: 'line',
                   data: {
                       labels: yearlyData.labels,
                       datasets: [{
                           label: 'Visitors',
                           data: yearlyData.data,
                           fill: false,
                           borderColor: '#007bff',
                           tension: 0.1
                       }]
                   },
                   options: {
                       scales: {
                           yAxes: [{
                               ticks: {
                                   beginAtZero: true
                               }
                           }]
                       }
                   }
               }); });
           </script>
       </div>
    </section>

    @livewire('dashboard.dashboard')

    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/jstree.min.js')) }}"></script>
@endsection
@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/charts/chart.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
     Page js files
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

     <script src="{{ asset(mix('js/scripts/extensions/ext-component-tree.js')) }}"></script>
@endsection
