@extends('layouts.contentLayoutMaster')

@section('title', 'Organizations')

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
    @if(Auth::check() && Auth::user()->role_id == 1)
<div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
    <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{{ route('OrganizationInformation.store') }}">
            {{ csrf_field() }}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">New Organization</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="form-group">
                    <label class="form-label" for="basic-icon-default-fullname">Name</label>
                    <input
                        type="text"
                        name="org_name"
                        :value="old('name')"
                        class="form-control dt-full-name"
                        id="basic-icon-default-fullname"
                        aria-describedby="basic-icon-default-fullname2"
                    />
                </div>


                <div class="form-group">
                    <label class="form-label" for="basic-icon-default-email">Email</label>
                    <input
                        type="email"
                        name="email"
                        :value="old('email')"
                        class="form-control dt-email"
                        aria-describedby="basic-icon-default-email2"
                        name="user-email"
                    />
                    <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                </div>

                <button type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
    @else
        <div class="card">
            <div class="pt-0 card-datatable table-responsive">
                <div class="card-datatable table-responsive">
                    <p style="font-size: large; color: orangered; padding-left: 40%" >"Unauthorized to access this page !!!!...."</p>
                </div>
            </div>
        </div>
    @endif
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
