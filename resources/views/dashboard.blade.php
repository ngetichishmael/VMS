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
    @livewire('dashboard.statistics')
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <!-- Medal Card -->

            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal"
                    style=" background: linear-gradient(to right, #15807A, rgb(111,178,190))">
                    <div class="card-body">

                        <p class="mx-1 card-text font-small-3"style="color: #fbfcfd">Visits</p>
                        <div class="media">
                            <div class="mr-2 avatar bg-light-primary">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="sunset" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr />
                            <div class="my-auto media-body">
                                <h4 class="mb-0 font-weight-bolder" style="color: #ffffff">{{ $totalVisitorsToday }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="mb-0 card-text font-small-3"style="color: #fbfcfd">Today</p>
                            </div>
                            <div class="my-auto media-body">
                                <h4 class="mb-0 font-weight-bolder" style="color: #ffffff">{{ $yesterdayVisitor }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="mb-0 card-text font-small-3"style="color: #fbfcfd">Yesterday</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal"
                    style=" background: linear-gradient(to right, #e75f04, #fdc39b)">
                    <div class="card-body">
                        <p class="mx-1 card-text font-small-3"style="color: #fbfcfd">Weekly Visits</p>
                        <div class="media">
                            <div class="mr-2 avatar bg-light-primary">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="sunset" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr />
                            <div class="my-auto media-body">
                                <h4 class="mb-0 font-weight-bolder" style="color: #ffffff">{{ $totalThisWeek }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="mb-0 card-text font-small-3"style="color: #fbfcfd">This Week</p>
                            </div>
                            <div class="my-auto media-body">
                                <h4 class="mb-0 font-weight-bolder" style="color: #ffffff">{{ $totalLastWeekVisit }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="mb-0 card-text font-small-3"style="color: #fbfcfd">Last Week</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal"
                    style=" background: linear-gradient(to right, #043331, #08dad1)">
                    <div class="card-body">
                        <p class="mx-1 card-text font-small-3"style="color: #fbfcfd">Motor Vehicle Count</p>
                        <div class="media">
                            <div class="mr-2 avatar bg-light-primary">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="building" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr />
                            <div class="my-auto media-body">
                                <h4 class="mb-0 font-weight-bolder" style="color: #ffffff">{{ $totalVehicleWeek }}</h4>
                                <hr style="color: #bebbbb" />
                                <p class="mb-0 card-text font-small-3"style="color: #fbfcfd">This Week</p>
                            </div>
                            <div class="my-auto media-body">
                                <h4 class="mb-0 font-weight-bolder" style="color: #ffffff">{{ $totalLastVehicleVisit }}
                                </h4>
                                <hr style="color: #bebbbb" />
                                <p class="mb-0 card-text font-small-3"style="color: #fbfcfd">Last Week</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal"
                    style=" background: linear-gradient(to right, #792e07, #ff8b4e)">
                    <div class="card-body">
                        <p class="mx-1 card-text font-small-3"style="color: #fbfcfd">Gender Comparison Last Week</p>
                        <div class="media">
                            <div class="mr-2 avatar bg-light-primary">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="sunset" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr />
                            <div class="my-auto media-body">
                                <h4 class="mb-0 font-weight-bolder" style="color: #ffffff">{{ $totalMaleLastWeek }}
                                </h4>
                                <hr style="color: #bebbbb" />
                                <p class="mb-0 card-text font-small-3"style="color: #fbfcfd">Male</p>
                            </div>
                            <div class="my-auto media-body">
                                <h4 class="mb-0 font-weight-bolder" style="color: #ffffff">{{ $totalFemaleLastWeek }}
                                </h4>
                                <hr style="color: #bebbbb" />
                                <p class="mb-0 card-text font-small-3"style="color: #fbfcfd">Female</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-tree.js')) }}"></script>
@endsection
