@extends('layouts.contentLayoutMaster')

@section('title', 'Premise Setting')

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
        <h4 class="card-title">#{{ $premise ->name }}</h4>
      </div>
      <div class="card-body">
      
      
      
      
        <form class="form"  method="post" action="{{ route('PremiseInformation.update', $premise->id) }}">
        @method('PATCH') 
        @csrf  
        <div class="row">

            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="last-name-column">Premise Name</label>
                    <input type="name" class="form-control"  name="name" value="{{ $premise ->name}}"   />
              </div>
            </div>

            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="last-name-column">Location</label>
                    <input type="text" class="form-control"  name="location"  value="{{ $premise ->location }}" />
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="city-column"> Address</label>
                <input type="text" class="form-control" name="address" value="{{ $premise ->address}}" /> 
             </div>
            </div>


            <div class="col-12 col-sm-6">
                                        <fieldset class="form-group">
                                          <label  for="user-role">Organization Name</label>
                                          <select  name="organization_code" class="form-control">
                                          <option  value="{{ $premise ->organization_code }}" > Select ...</option>
                                            @foreach ($organization as $org)
                                                <option  value="{{ $org ->code }}"> {{ $org ->name }}</option>
                                            @endforeach  
                                          </select>
                                        </fieldset>
                                        </div>
        
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="email-id-column">Description</label>
                <textarea class="form-control"  name="description"   rows="3" >{{ $premise ->description}}</textarea>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary mr-1">Update</button>

              <a href="{{ route('PremiseInformation') }}" type="reset" class="btn btn-outline-secondary">Cancel</a>
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
