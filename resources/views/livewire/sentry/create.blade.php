@extends('layouts.contentLayoutMaster')

@section('title', 'Add New Sentry')

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
                        &nbsp;Personal Information </h5>
                    <div class="row">
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Full Name</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Gender</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >ID Number</label>
                                <input type="number" class="form-control"  />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Date of Birth</label>
                                <input type="date" class="form-control"  />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Organization</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6  mb-1 pl-2">
                            <div class="form-group">
                                <label >Physical Address</label>
                                <input type="text" class="form-control" />
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
                            <span class="align-middle">  &nbsp; Contact Information</span>
                        </h6>
                    <div class="row">
                        <div class="col-md-10  mb-1">
                            <div class="form-group">
                                <label >Primary Phone Number</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-10  mb-1">
                            <div class="form-group">
                                <label >Secondary Phone Number</label>
                                <input type="text" class="form-control"  />
                            </div>
                        </div>

                    </div>
                    <div class="row">


                    </div>
                </div>
            </div>

        </div>


            <div class="col-md-3">
                    <button wire:click.prevent="create" type="button" class="btn btn-icon btn-outline-success" style="background-color: #1877F2;color:#fff;"  data-toggle="modal" id="smallButton"
                            data-placement="top" >
                             Create

                        </button>
          </div>
            <!-- <div class="mt-2 col-12 d-flex flex-sm-row flex-column" style="gap: 20px;">
                <a href="{{ route('VisitDriveIn') }}" type="reset" style="margin-left: 85%;background: #73b2ef; color: #ffffff"
                   class="btn btn-btn-secondary">  Back </a>
            </div> -->


@endsection

@section('vendor-script')
    {{-- vendor files --}}

@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-tree.js')) }}"></script>
@endsection
