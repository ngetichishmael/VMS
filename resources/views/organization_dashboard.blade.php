<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->

        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal"
                 style=" background: linear-gradient(to right, #15807A, rgb(111,178,190))">
                <div class="card-body">

                    <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">VISITS TODAY</p>
                    <div class="media" style="text-align: center">
                        <div class="avatar bg-light-primary mr-2">
                            <div class="avatar-content" style="background: whitesmoke">
                                <i data-feather="users" class="avatar-icon"></i>
                            </div>
                        </div>
                        <hr />
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $totalVisitorsToday}}</h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">TODAY
                                @php
                                    $percentChange = $yesterdayVisitor > 0 ? ($totalVisitorsToday - $yesterdayVisitor) / $yesterdayVisitor * 100 : 100;
                                    $percentChange = number_format($percentChange, 1);
                                    $color = $percentChange > 0 ? 'green' : 'orange';
                                    $arrow = $percentChange > 0 ? 'fa fa-arrow-up' : 'fa fa-arrow-down';
                                @endphp
                                <span>{{ $percentChange }}%</span> <i style="color: {{ $color }}" class="{{ $arrow }}"></i>

                            </p>
                        </div>
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $yesterdayVisitor}}</h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">YESTERDAY&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal"
                 style=" background: linear-gradient(to right, #e75f04, #fdc39b)">
                <div class="card-body">
                    <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">WEEKLY VISITS</p>
                    <div class="media" style="text-align: center">
                        <div class="avatar bg-light-primary mr-2">
                            <div class="avatar-content" style="background: whitesmoke">
                                <i data-feather="calendar" class="avatar-icon"></i>
                            </div>
                        </div>
                        <hr />
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $totalThisWeek }}</h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-2 mb-0"style="color: #fbfcfd">THIS WEEK
                                @php
                                    $percentChange = $totalLastWeekVisit > 0 ? ($totalThisWeek - $totalLastWeekVisit) / $totalLastWeekVisit * 100: 100;
                                    $percentChange = number_format($percentChange, 1);
                                    $color = $percentChange > 0 ? 'green' : 'orange';
                                    $arrow = $percentChange > 0 ? 'fa fa-arrow-up' : 'fa fa-arrow-down';
                                @endphp
                                <span>{{ $percentChange }}%</span> <i style="color: {{ $color }}" class="{{ $arrow }}"></i>

                            </p>
                        </div>
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $totalLastWeekVisit }}</h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-3 mb-0"style="color: #fbfcfd"> LAST WEEK</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-12" >
            <div class="card card-congratulation-medal"
                 style=" background: linear-gradient(to right, #792e07, #ff8b4e)">
                <div class="card-body" >
                    <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">ID CHECK-IN THIS WEEK</p>
                    <div class="media" style="text-align: center">
                        <div class="avatar bg-light-primary mr-2">
                            <div class="avatar-content" style="background: whitesmoke">
                                <i data-feather="" class="avatar-icon fa fa-id-card-alt"></i>
                            </div>
                        </div>
                        <hr />
                        <div class="media-body my-auto" >
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $idThisWeek }}
                            </h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-2 mb-0"style="color: #fbfcfd">THIS WEEK
                                @php
                                    $percentChange = $yesterdayVisitor > 0 ? ($totalVisitorsToday - $yesterdayVisitor) / $yesterdayVisitor * 100 : 100;
                                   $percentChange = number_format($percentChange, 1);
                                    $color = $percentChange > 0 ? 'green' : 'orange';
                                    $arrow = $percentChange > 0 ? 'fa fa-arrow-up' : 'fa fa-arrow-down';
                                @endphp
                                <span>{{ $percentChange }}%</span> <i style="color: {{ $color }}" class="{{ $arrow }}"></i>
                            </p>
                        </div>
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $idLastWeek }}
                            </h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">LAST WEEK</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal"
                 style=" background: linear-gradient(to right, #0b5777, #69adcb)">
                <div class="card-body">
                    <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">WALK CHECK-IN THIS WEEK</p>
                    <div class="media" style="text-align: center">
                        <div class="avatar bg-light-primary mr-2">
                            <div class="avatar-content" style="background: whitesmoke">
                                <i data-feather="walk-direction" class="avatar-icon fa fa-walking"></i>
                            </div>
                        </div>
                        <hr />
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $walkinThisWeek }}</h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-2 mb-0"style="color: #fbfcfd">THIS WEEK

                                @php
                                    $percentChange = $walkinLastWeek > 0 ? ($walkinThisWeek - $walkinLastWeek) / $walkinLastWeek * 100 : 100;
                                   $percentChange = number_format($percentChange, 1);
                                    $color = $percentChange > 0 ? 'green' : 'orange';
                                    $arrow = $percentChange > 0 ? 'fa fa-arrow-up' : 'fa fa-arrow-down';
                                @endphp
                                <span>{{ $percentChange }}%</span> <i style="color: {{ $color }}" class="{{ $arrow }}"></i>
                            </p>
                        </div>
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $walkinLastWeek}}</h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">LAST WEEK</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal"
                 style=" background: linear-gradient(to right, #295922, #94ee88)">
                <div class="card-body">
                    <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">DRIVE CHECK-IN THIS WEEK</p>
                    <div class="media" style="text-align: center">
                        <div class="avatar bg-light-primary mr-2">
                            <div class="avatar-content" style="background: whitesmoke">
                                <i data-feather="car" class="avatar-icon fa fa-car-alt"></i>
                            </div>
                        </div>
                        <hr />
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $driveinThisWeek }}</h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-2 mb-0"style="color: #fbfcfd">THIS WEEK
                                @php
                                    $percentChange = $driveinLastWeek > 0 ? ($driveinThisWeek - $driveinLastWeek) / $driveinLastWeek * 100 : 100;
                                   $percentChange = number_format($percentChange, 1);
                                    $color = $percentChange > 0 ? 'green' : 'orange';
                                    $arrow = $percentChange > 0 ? 'fa fa-arrow-up' : 'fa fa-arrow-down';
                                @endphp
                                <span>{{ $percentChange }}%</span> <i style="color: {{ $color }}" class="{{ $arrow }}"></i>
                            </p>
                        </div>
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $driveinLastWeek }}</h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">LAST WEEK</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--            <div class="col-xl-4 col-md-6 col-12">--}}
        {{--                <div class="card card-congratulation-medal"--}}
        {{--                     style=" background: linear-gradient(to right, #1f4983, #668cbd)">--}}
        {{--                    <div class="card-body">--}}
        {{--                        <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">iPass CHECK-IN THIS WEEK</p>--}}
        {{--                        <div class="media" style="text-align: center">--}}
        {{--                            <div class="avatar bg-light-primary mr-2">--}}
        {{--                                <div class="avatar-content" style="background: whitesmoke">--}}
        {{--                                    <i data-feather="badge" class="avatar-icon fa fa-id-badge"></i>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            <hr />--}}
        {{--                            <div class="media-body my-auto">--}}
        {{--                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $ipassThisWeek }}</h4>--}}
        {{--                                <hr style="color: #bebbbb" />--}}
        {{--                                <p class="card-text font-small-2 mb-0"style="color: #fbfcfd">THIS WEEK--}}
        {{--                                    @php--}}
        {{--                                        $percentChange = $ipassLastWeek > 0 ? ($ipassThisWeek - $ipassLastWeek) / $ipassLastWeek * 100 : 100;--}}
        {{--                                       $percentChange = number_format($percentChange, 1);--}}
        {{--                                        $color = $percentChange > 0 ? 'green' : 'orange';--}}
        {{--                                        $arrow = $percentChange > 0 ? 'fa fa-arrow-up' : 'fa fa-arrow-down';--}}
        {{--                                    @endphp--}}
        {{--                                    <span>{{ $percentChange }}%</span> <i style="color: {{ $color }}" class="{{ $arrow }}"></i>--}}
        {{--                                </p>--}}
        {{--                            </div>--}}
        {{--                            <div class="media-body my-auto">--}}
        {{--                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $ipassLastWeek }}</h4>--}}
        {{--                                <hr style="color: #bebbbb" />--}}
        {{--                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">LAST WEEK</p>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal"
                 style=" background: linear-gradient(to right, rgba(124,17,17,0.7), rgba(180,112,112,0.7))">
                <div class="card-body">
                    <p class="card-text font-small-3 mx-1"style="color: #fbfcfd">SMS CHECK-IN THIS WEEK</p>
                    <div class="media" style="text-align: center">
                        <div class="avatar bg-light-primary mr-2">
                            <div class="avatar-content" style="background: whitesmoke">
                                <i data-feather="sms" class="avatar-icon fa fa-sms"></i>
                            </div>
                        </div>
                        <hr />
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $smsThisWeek }}</h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-2 mb-0"style="color: #fbfcfd">THIS WEEK
                                @php
                                    $percentChange = $smsLastWeek > 0 ? ($smsThisWeek - $smsLastWeek) / $smsLastWeek * 100 : 100;
                                   $percentChange = number_format($percentChange, 1);
                                    $color = $percentChange > 0 ? 'green' : 'orange';
                                    $arrow = $percentChange > 0 ? 'fa fa-arrow-up' : 'fa fa-arrow-down';
                                @endphp
                                <span>{{ $percentChange }}%</span> <i style="color: {{ $color }}" class="{{ $arrow }}"></i>
                            </p>
                        </div>
                        <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0" style="color: #ffffff">{{ $smsLastWeek }}</h4>
                            <hr style="color: #bebbbb" />
                            <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">LAST WEEK</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="row">

        <div class="col-xl-6 col-12"  >
            <div class="card">
                <div class="card-header font-small-3">
                    <h5>Units with highest number of visitors this month</h5>
                    <div class="card-text font-small-3 col-12" >
                        @foreach($units as $unit)
                            <h6>{{ $unit->name }} ({{ $unit->visitors_count }} visitors)</h6>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ $unit->visitors_count }}%;" aria-valuenow="{{ $unit->visitors_count }}" aria-valuemin="0" aria-valuemax="{{ $units->max('visitors_count') }}"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12">
            <div class="card col-8">
                <div class="card-header font-small-3">
                    <h6>{!! ucwords("Organization with the Highest Monthly Visits") !!}</h6>
                    <div class="card-text font-small-3">
                        <i class="fa fa-building"><span>{!! $organization->name !!}</span><span> Visits: {!! $organization->visitor_count !!}</span></i>
                    </div>
                </div>
            </div>
        </div>
    </div></div>
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
                        },
                        barThickness: 10
                    }
                });
            });

        </script>
        <!-- Horizontal Bar Chart End -->
        <div class="col-xl-6 col-12">
            <div class="card">
                <div class="card-header">
                    <p class="card-subtitle text-muted mb-25">{!! ucwords("Monthly Visits by Age") !!}</p>
                    <h4 class="card-title">{!! ucwords("Monthly Visits by AGE") !!}</h4>
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
    <div class="card">
        <div class="col-xl-6 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                    <div class="header-left">
                        <p class="card-subtitle text-muted mb-25">Yearly Visitors for {!! now()->year !!}</p>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="yearly-visitors" class="chartjs" data-height="400"></canvas>
                </div>
                <p class="card-text mb-0 pl-4 pb-5">TOTAL VISITORS : {{ $totalVisitors}}</p>
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
                            borderWidth: 1,
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
        <div>
            <div class="card">
                <div class="card-header">
                    Visitors Chart
                </div>
                <div class="card-body">
                    <canvas id="visitorChart" data-height="400"></canvas>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var chartData = <?php echo json_encode($chartDataL); ?>;

                    var ctx = document.getElementById('visitorChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'line',
                        data: chartData,
                        options: {
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
        </div>
    </div>
</section>
