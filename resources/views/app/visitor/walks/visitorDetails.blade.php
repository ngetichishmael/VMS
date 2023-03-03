@extends('layouts.contentLayoutMaster')

@section('title', 'Walk-in Visitor Details')

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
    <style>
        .card {
            display: flex;
            flex-wrap: wrap;
            background-color: #fff;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            /*border-radius: 4px;*/
            overflow: hidden;


        }
        .image-container {
            width: 30%;
            flex: 0 0 30%;
            height: auto;

        }

        .card-left img {
            display: block;
            width: 60%;
            height: 80%;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;

        }

        .card-right {
            width: 60%;
            flex: 0 0 60%;
            padding-left: 20px;
        }

        .card-right .details {
            display: flex;
            flex-wrap: wrap;
        }

        .card-right .details span {
            width: 100%;
            flex: 0 0 100%;
            color: #555;

        }


        .destination-card {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
            background-color: #fff;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .destination-card-left {
            width: 40%;
            flex: 0 0 40%;
            padding: 20px;
        }

        .destination-card-right {
            width: 60%;
            flex: 0 0 60%;
            padding: 20px;
        }

        .destination-card-right .visitor-info {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .destination-card-right .visitor-info span {
            width: 50%;
            flex: 0 0 50%;
            color: #555;
            margin-bottom: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 10px;
        }

        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: 600;
            color: #333;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-gap: 20px;
            align-items: stretch;

        }
        .grid >img {
            max-width: 100%;
        }
    </style>
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container" style="font-size: small">
        <div class="row pl-3">
            <div class="destination-card">
                <div class="destination-card-left">
                    <div class="card">
                        <h5 class="card-title" style="color: #1f8af5;">
                            <i data-feather="lock" class="font-medium-3 mr-25 fa fa-user-alt"></i>
                            &nbsp;Visitor Information
                        </h5>
                        {{--                    <div class="card-left">--}}
                        {{--                        <img src="image-placeholder.jpg" alt="Visitor Image" width="100px" height="150px" style="background: #2e3750">--}}
                        {{--                    </div>--}}
                        <div class="image-container pl-2" style="width: 200px; height: 150px">
                            @if($visitor->user_details->image)
                                <img src="{{ asset('storage/attachments/'.$visitor->user_details->image) }}" alt="{{ $visitor->name }}'s ID picture" width="50" height="40"/>
                            @else
                                <div class="image-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-right">
                            <div class="details">
                                <span><strong>Name:</strong> {{ $visitor->name }}</span>
                                <br>
                                <span><strong>Gender:</strong> {{ ucwords($visitor->user_details->gender) }}</span>
                                <span><strong>Checked-in By:</strong> {{ $visitor->sentry->name ?? 'Unknown' }}</span>

                                <ul class="list-group list-group-flush" style="color: #78be6f" >
                                    <li class="list-group-item" ><strong>No. of Visits: {{ $visitorCount ?? '0' }}</strong></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    {{--                <div class="row">--}}
                    {{--                    <div class="card col-4">--}}
                    {{--                        <div class="card-body" >--}}
                    <h6 class="py-1 pl-2 mx-1 mb-0 font-medium-2 card-title" style="color: #1f8af5; padding-left: 8%;">
                        <i data-feather="lock" class="font-medium-3 mr-25 fa fa-building" ></i>
                        <span class="align-middle">  &nbsp; Visitor's Destination Premises</span>
                    </h6>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label >Company Name</label>
                                <input type="text" class="form-control" value="{{ $visitor->user_details->company ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label >Premises Name</label>
                                <input type="text" class="form-control" value="{{ $visitor->Resident->unit->block->premise->name ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label >Block Name</label>
                                <input type="text" class="form-control" value="{{ $visitor->Resident->unit->block->name ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label >Destination</label>
                                <input type="text" class="form-control" value="{{ $visitor->Resident->unit->name ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label >Signed In By</label>
                                <input type="text" class="form-control" value="{{ $visitor->sentry->name ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                    </div>
                    {{--                        </div>--}}

                    {{--                    </div>--}}

                    {{--                </div>--}}
                </div>
                <div class="destination-card-right">
                    <div class="visitor-info">
                        <div class="col-md-12 mb-1">
                            <h5 class="card-title" style="color: #1f8af5;">
                                <i data-feather="lock" class="font-medium-3 mr-25 "></i>
                                &nbsp;Other Visitor Details
                            </h5>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="form-group">
                                <label>Identification Number</label>
                                <input type="text" class="form-control" value="{{ $visitor->user_details->ID_number ?? 'Not Available' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1 pl-1">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="text" class="form-control" value="{{ $visitor->user_details->date_of_birth ?? 'Not Available' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1 pl-1">
                            <div class="form-group">
                                <label>Visitor Type</label>
                                <input type="text" class="form-control" value="{!! $visitor->visitorType->name ?? 'Not Available' !!}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1 pl-1">
                            <div class="form-group">
                                <label>Nationality</label>
                                <input type="text" class="form-control" value="{!! $visitor->nationality->name ?? 'Not Available' !!}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1 pl-1">
                            <div class="form-group">
                                <label>Host Name</label>
                                <input type="text" class="form-control" value="{!! $visitor->Resident->name ?? 'Not Available' !!}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1 pl-1">
                            <div class="form-group">
                                <label>Purpose</label>
                                <input type="text" class="form-control" value="{!! $visitor->purpose1->purpose_description ?? 'Not Available' !!}"
                                       readonly />
                            </div>
                        </div>
                        <div class="col-md-4  mb-1 pl-1">
                            <div class="form-group">
                                <label >Phone Number</label>
                                <input type="text" class="form-control" value="{{ $visitor->user_details->phone_number ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4  mb-1 pl-1">
                            <div class="form-group">
                                <label >Alternative Phone Number</label>
                                <input type="text" class="form-control" value="{{ $visitor->user_details->secondary_phone_number ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-1">
                            <div class="form-group">
                                <label >Last Check-in</label>
                                <input type="text" class="form-control" value="{{ $lastTimeLog->entry_time ?? 'Visitor Still in' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-1">
                            <div class="form-group">
                                <label >Last Check-out</label>
                                <input type="text" class="form-control" value="{{ $lastTimeLog->exit_time ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-12 mb-1 pl-1">
                                        <div class="form-group">
                                            <label >Duration</label>
                                            <input type="text" class="form-control" value="{!! Carbon::parse($visitor->timeLog->entry_time ?? now())->diff(Carbon::parse($visitor->timeLog->exit_time ?? now()))->format('%H Hours %I Minutes %S Seconds'); !!} " readonly />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($visitor->vehicle!=null)
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title" style="color: #1f8af5">Vehicle Information</h5>
                                        <div class="col-md-6 mb-1 pl-1">
                                            <div class="form-group">
                                                <label >Registration</label>
                                                <input type="text" class="form-control" value="{{ $visitor->vehicle->registration?? 'Not Available' }}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            @if(($visitor->attachment1)!=null || ($visitor->attachment2)!=null || ($visitor->attachment3)!=null || ($visitor->attachment4)!=null)
                <div class="card col-12">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #1f8af5">Image Attachments</h5>
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ asset('storage/attachments/'.$visitor->attachment1) }}" data-fancybox>
                                        <img src="{{ asset('storage/attachments/'.$visitor->attachment1) }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ asset('storage/attachments/'.$visitor->attachment2) }}" data-fancybox>
                                        <img src="{{ asset('storage/attachments/'.$visitor->attachment2) }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ asset('storage/attachments/'.$visitor->attachment3) }}" data-fancybox>
                                        <img src="{{ asset('storage/attachments/'.$visitor->attachment3) }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ asset('storage/attachments/'.$visitor->attachment4) }}" data-fancybox>
                                        <img src="{{ asset('storage/attachments/'.$visitor->attachment4) }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @endif
            <div class="card col-12">
                <div class="card-body">
                    <h5 class="card-title" style="color: #1f8af5">Visitor History</h5>
                    <div class="row col-12">
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Duration</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($HistoryTimeLogs as $driveIn)
                                    @foreach ($driveIn->timeLogs as $timeLog)
                                        <tr>
                                            <td>{{ $timeLog->entry_time ? Carbon::parse($timeLog->entry_time)->format('m/d/Y') : '-' }}</td>
                                            <td>{{ $timeLog->entry_time ? Carbon::parse($timeLog->entry_time)->format('h:i A') : '-' }}</td>
                                            <td>{{ $timeLog->exit_time ? Carbon::parse($timeLog->exit_time)->format('h:i A') : '-' }}</td>
                                            <td>{!! Carbon::parse($timeLog->entry_time ?? now())->diff(Carbon::parse($timeLog->exit_time ?? now()))->format('%H Hours %I Minutes %S Seconds') !!}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 col-12 d-flex flex-sm-row flex-column" style="gap: 20px;">
                <a href="{{ route('VisitWalkIn') }}" type="reset" style="margin-left: 85%;background: #54a4f3; color: #ffffff"
                   class="btn btn-btn-secondary">  <i class="fa fa-backspace"> Back </i> </a>
            </div></div>
    </div>

        @endsection

        @section('vendor-script')
            {{-- vendor files --}}

        @endsection
        @section('page-script')
            {{-- Page js files --}}
            <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
            <script src="{{ asset(mix('js/scripts/extensions/ext-component-tree.js')) }}"></script>
@endsection
