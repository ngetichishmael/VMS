@extends('layouts.contentLayoutMaster')

@section('title', 'Resident Setting')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

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
  
<section id="multiple-column-form">
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">#{{ $resident ->name }}</h4>
      </div>
      <div class="card-body">
      
      
      
      
        <form class="form"  method="post" action="{{ route('ResidentInformation.update', $resident->id) }}">
        @method('PATCH') 
        @csrf  
        <div class="row">

            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="last-name-column">Resident Name</label>
                    <input type="name" class="form-control"  name="name" value="{{ $resident ->name}}"   required/>
              </div>
            </div>

            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="city-column">Email Address</label>
                <input type="email" class="form-control" name="email" value="{{ $resident ->email}}" required/> 
             </div>
            </div>

            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="last-name-column">Phone Number</label>
                    <input type="tel" class="form-control"  name="phone_number"  value="{{ $resident ->phone_number }}" required/>
              </div>
            </div>

            <div class="col-12 col-sm-6">
                                        <fieldset class="form-group">
                                          <label  for="user-role">Unit Name</label>
                                          <select  name="unit_id" class="form-control">
                                            @foreach ($unit as $uni)
                                                <option value="{{ $uni ->id }}" @if($uni ->id == $resident->unit_id) selected @endif>{{ $uni->name }}</option>

                                            @endforeach  
                                          </select>
                                        </fieldset>
                                        </div>
      
            <div class="col-12">
              <button type="submit" class="btn btn-primary mr-1">Update</button>

              <a href="{{ route('ResidentInformation') }}" type="reset" class="btn btn-outline-secondary">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</section>
<!-- Basic Floating Label Form section end -->


@endsection


@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-tree.js')) }}"></script>
@endsection
