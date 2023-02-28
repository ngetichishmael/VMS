@extends('layouts.contentLayoutMaster')

@section('title', 'Edit Organization')

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
    <section id="page-account-settings">
            @if (session('status'))
                <div class="col-md-6 col-xl-12">
                    <div class="card bg-success text-white">
                      <div class="card-body">
                        <p class="card-text">    {{ session('status') }}</p>
                      </div>
                    </div>
                  </div>
            @elseif (session('error'))
                <div class="col-md-6 col-xl-12">
                    <div class="card bg-danger text-white">
                      <div class="card-body">
                        <p class="card-text"> {{ session('error') }}</p>
                      </div>
                    </div>
                  </div>
            @endif
        <div class="row">
  

            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">


                        

                            <!-- change password -->
                            <div class="tab-pane  active" id="account-vertical-password" role="tabpanel"
                                aria-labelledby="account-pill-password" aria-expanded="false">

   

                                <!-- form -->
                                <form class="validate-form mt-2" method="post" action="{{ route('OrganizationInformation.update', $organization->id) }}">
                                @method('PATCH') 
            @csrf   
                                <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-username">Full Names</label>
                                                <input type="text" class="form-control" 
                                                    name="name" 
                                                    value="{{ $organization ->name }}"  />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-name">Email</label>
                                                <input type="email" class="form-control" 
                                                 name="email"
                                                  value="{{ $organization ->email}}"   />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-e-mail">Phone Number</label>
                                                <input type="tel" class="form-control" 
                                                    name="primary_phone" 
                                                    value="{{ $organization ->primary_phone }}" 
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-e-mail">AlternativePhone Number</label>
                                                <input type="tel" class="form-control" 
                                                    name="secondary_phone" 
                                                    value="{{ $organization ->secondary_phone}}" 
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-e-mail">Location</label>
                                                <input type="text" class="form-control" 
                                                    name="location" 
                                                    value="{{ $organization ->location}}" 
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-e-mail">WebsiteUrl</label>
                                                <input type="tel" class="form-control" 
                                                    name="websiteUrl" 
                                                    value="{{ $organization ->websiteUrl }}" 
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-e-mail">Description</label>
                                                <textarea
                                                    class="form-control"
                                                    name="description" 
                                                    value="{{ $organization ->description}}" 
                                                    rows="3"
                                               ></textarea>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mt-1">Update</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                    </div>

                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                            <!--/ change password -->


                        </div>
                    </div>
                </div>
            </div>
            <!--/ right content section -->
        </div>
    </section>
@endsection


@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-tree.js')) }}"></script>
@endsection
