@extends('layouts.contentLayoutMaster')

@section('title', 'Premises')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
   <link rel="stylesheet" href="{{ asset(mix('fonts/font-awesome/css/font-awesome.min.css')) }}">
@endsection

@section('content')
    @if(Auth::check() && Auth::user()->role_id == 1)
        <!-- Dashboard Ecommerce Starts -->
        @livewire('premises.premise.dashboard')
        <!-- Dashboard Ecommerce ends -->
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
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
@section('vendor-script')
{{-- vendor files --}}
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
@endsection

