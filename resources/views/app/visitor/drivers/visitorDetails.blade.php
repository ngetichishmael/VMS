@extends('layouts.contentLayoutMaster')

@section('title', 'Drive-in Visitor Details')

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
    <div class="row" style="padding-left: 5%" >
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="color: #1f8af5; padding-left: 10%" >
                        <i data-feather="lock" class="font-medium-3 mr-25 fa fa-user-alt" > </i>
                        &nbsp;Visitor Information </h5>
                    <div class="row">
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Full Name</label>
                                <input type="text" class="form-control" value="{{ $visitor->name ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Gender</label>
                                <input type="text" class="form-control" value="{{ $visitor->user_details->gender ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
{{--                        <div class="col-md-6  mb-1 pl-2">--}}
{{--                            <div class="form-group">--}}
{{--                                <label >Identification Type</label>--}}
{{--                                <input type="text" class="form-control" value="{!! $visitor->identificationType->name ?? 'Not Available' !!}" readonly />--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Identification Number</label>
                                <input type="text" class="form-control" value="{{ $visitor->user_details->ID_number ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Date of Birth</label>
                                <input type="text" class="form-control" value="{{ $visitor->user_details->date_of_birth ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Visitor Type</label>
                                <input type="text" class="form-control" value="{!! $visitor->visitorType->name ?? 'Not Available' !!}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Nationality</label>
                                <input type="text" class="form-control" value="{!! $visitor->nationality->name ?? 'Not Available' !!}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Host Name</label>
                                <input type="text" class="form-control" value="{!! $visitor->Resident->name ?? 'Not Available' !!}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Purpose</label>
                                <input type="text" class="form-control" value="{!! $visitor->purpose1->purpose_description ?? 'Not Available' !!}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Phone Number</label>
                                <input type="text" class="form-control" value="{{ $visitor->user_details->phone_number ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Alternative Phone Number</label>
                                <input type="text" class="form-control" value="{{ $visitor->user_details->secondary_phone_number ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        </hr></br>

                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Time Check-in</label>
                                <input type="text" class="form-control" value="{{ $visitor->timeLogs->entry_time ?? 'Visitor Still in' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Time Check-out</label>
                                <input type="text" class="form-control" value="{{ $visitor->timeLogs->exit_time ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 pl-2">
                            <div class="form-group">
                                <label >Duration</label>
                                <input type="text" class="form-control" value="{{ $visitor->duration ?? 'Not Available' }}" readonly />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                        <h6 class="py-0 mx-1 mb-1 font-medium-2 card-title" style="color: #1f8af5;">
                            <i data-feather="lock" class="font-medium-3 mr-25 fa fa-car-alt" ></i>
                            <span class="align-middle">  &nbsp; Visitor's Vehicle Information</span>
                        </h6>
                    <div class="row">
                        <div class="col-md-10  mb-1">
                            <div class="form-group">
                                <label >Vehicle Registration</label>
                                <input type="text" class="form-control" value="{{ $visitor->vehicle->registration ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" >
                    <h6 class="py-1 pl-2 mx-1 mb-0 font-medium-2 card-title" style="color: #1f8af5; padding-left: 8%;">
                        <i data-feather="lock" class="font-medium-3 mr-25 fa fa-building" ></i>
                        <span class="align-middle">  &nbsp; Visitor's Destination Premises</span>
                    </h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Company Name</label>
                                <input type="text" class="form-control" value="{{ $visitor->Resident->unit->block->premise->organization->name ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Premises Name</label>
                                <input type="text" class="form-control" value="{{ $visitor->Resident->unit->block->premise->name ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Premises Information</label>
                                <input type="text" class="form-control" value="{{ $visitor->Resident->unit->block->premise->description?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Block Name</label>
                                <input type="text" class="form-control" value="{{ $visitor->Resident->unit->block->name ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Unit Destination</label>
                                <input type="text" class="form-control" value="{{ $visitor->Resident->unit->name ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Signed In By</label>
                                <input type="text" class="form-control" value="{{ $visitor->createdBy2->name ?? 'Not Available' }}" readonly />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-2 col-12 d-flex flex-sm-row flex-column" style="gap: 20px;">
                <a href="{{ route('VisitDriveIn') }}" type="reset" style="margin-left: 85%;background: #73b2ef; color: #ffffff"
                   class="btn btn-btn-secondary">  Back </a>
            </div>
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
