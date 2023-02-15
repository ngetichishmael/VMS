@extends('layouts.contentLayoutMaster')

@section('title', 'VMS Dashboard')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('fonts/font-awesome/css/font-awesome.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/jstree.min.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}

    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-tree.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce" >
        <div style="right: 0px; padding-right: 2px;">{{ now() }}</div>
        <div class="row match-height">
            <!-- Medal Card -->
            <div class="col-xl-4 col-md-6 col-12" >
                <div class="card card-congratulation-medal" style=" background: linear-gradient(to right, #15807A, rgb(111,178,190))">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar bg-light-primary mr-2">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="sunset" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr/>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff" >{{ $totalVisitorsToday }}</h4>
                                <hr style="color: #bebbbb"/>
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Total Visitors Today</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12" >
                <div class="card card-congratulation-medal" style=" background: linear-gradient(to right, #e75f04, #fdc39b)">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar bg-light-primary mr-2">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="sunset" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr/>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff" >{{ $totalVisitorsWeekly }}</h4>
                                <hr style="color: #bebbbb"/>
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Total Weekly Visits</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12" >
                <div class="card card-congratulation-medal" style=" background: linear-gradient(to right, #043331, #08dad1)">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar bg-light-primary mr-2">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="building" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr/>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff" >230</h4>
                                <hr style="color: #bebbbb"/>
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Most Visited Site</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12" >
                <div class="card card-congratulation-medal" style=" background: linear-gradient(to right, #792e07, #ff8b4e)">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar bg-light-primary mr-2">
                                <div class="avatar-content" style="background: whitesmoke">
                                    <i data-feather="sunset" class="avatar-icon"></i>
                                </div>
                            </div>
                            <hr/>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0" style="color: #ffffff" >230</h4>
                                <hr style="color: #bebbbb"/>
                                <p class="card-text font-small-3 mb-0"style="color: #fbfcfd">Visitor per Building</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--/ Medal Card -->

            <!-- Statistics Card -->
{{--            <div class="col-xl-8 col-md-6 col-12">--}}
{{--                <div class="card card-statistics">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4 class="card-title">Statistics</h4>--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <p class="card-text font-small-2 mr-25 mb-0">This month</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body statistics-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="avatar bg-light-primary mr-2">--}}
{{--                                        <div class="avatar-content">--}}
{{--                                            <i data-feather="sunset" class="avatar-icon"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body my-auto">--}}
{{--                                        <h4 class="font-weight-bolder mb-0">230</h4>--}}
{{--                                        <p class="card-text font-small-3 mb-0">Today</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="avatar bg-light-info mr-2">--}}
{{--                                        <div class="avatar-content">--}}
{{--                                            <i data-feather="navigation-2" class="avatar-icon"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body my-auto">--}}
{{--                                        <h4 class="font-weight-bolder mb-0">590</h4>--}}
{{--                                        <p class="card-text font-small-3 mb-0">This Week</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="avatar bg-light-danger mr-2">--}}
{{--                                        <div class="avatar-content">--}}
{{--                                            <i data-feather="calendar" class="avatar-icon"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body my-auto">--}}
{{--                                        <h4 class="font-weight-bolder mb-0">2000</h4>--}}
{{--                                        <p class="card-text font-small-3 mb-0">This Month</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-xl-3 col-sm-6 col-12">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="avatar bg-light-success mr-2">--}}
{{--                                        <div class="avatar-content">--}}
{{--                                            <i data-feather="layers" class="avatar-icon"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body my-auto">--}}
{{--                                        <h4 class="font-weight-bolder mb-0">23000</h4>--}}
{{--                                        <p class="card-text font-small-3 mb-0">Total</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!--/ Statistics Card -->
        </div>

{{--        <h2 class="brand-text">TODO ON DASHBOARD</h2>--}}
{{--        <div class="card-body">--}}
{{--            <div id="jstree-basic">--}}
{{--                <ul>--}}
{{--                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                        Summary--}}
{{--                        <ul>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Weekly Summary</li>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Most Visited Sites</li>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Visitors Per Building</li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                        Analysis--}}
{{--                        <ul data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                            <li data-jstree='{"icon" : "far fa-file-image"}'>Monthly</li>--}}
{{--                            <li data-jstree='{"icon" : "far fa-file-image"}'>Weekly</li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                        Table--}}
{{--                        <ul>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Drive In</li>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Walk in</li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li data-jstree='{"icon" : "fab fa-html5"}'>Any Other</li>--}}
{{--                    <li data-jstree='{"icon" : "fab fa-html5"}'>Martin to Advise</li>--}}
{{--                    <li data-jstree='{"icon" : "fab fa-html5"}'>Isaac to Provide images, and secondary colors</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
    </section>
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
    <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-tree.js')) }}"></script>
@endsection
