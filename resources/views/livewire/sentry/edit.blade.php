@extends('layouts/contentLayoutMaster')

@section('title', 'Guard Settings')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- account setting page -->
<section id="page-account-settings">
  <div class="row">
    <!-- left menu section -->
    <div class="col-md-3 mb-2 mb-md-0">
      <ul class="nav nav-pills flex-column nav-left">
        <!-- general -->
        <li class="nav-item">
          <a
            class="nav-link active"
            id="account-pill-general"
            data-toggle="pill"
            href="#account-vertical-general"
            aria-expanded="true"
          >
            <i data-feather="user" class="font-medium-3 mr-1"></i>
            <span class="font-weight-bold">General</span>
          </a>
        </li>
   
        <!-- information -->
        <li class="nav-item">
          <a
            class="nav-link"
            id="account-pill-info"
            data-toggle="pill"
            href="#account-vertical-info"
            aria-expanded="false"
          >
            <i data-feather="info" class="font-medium-3 mr-1"></i>
            <span class="font-weight-bold">Information</span>
          </a>
        </li>
 
  
      </ul>
    </div>
    <!--/ left menu section -->

    <!-- right content section -->
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">
          <div class="tab-content">
            <!-- general tab -->
            <div
              role="tabpanel"
              class="tab-pane active"
              id="account-vertical-general"
              aria-labelledby="account-pill-general"
              aria-expanded="true"
            >
              <!-- header media -->
              <div class="media">
                <a href="javascript:void(0);" class="mr-25">
                  <img
                    src="{{asset('images/portrait/small/avatar-s-11.jpg')}}"
                    id="account-upload-img"
                    class="rounded mr-50"
                    alt="profile image"
                    height="80"
                    width="80"
                  />
                </a>
                <!-- upload and reset button -->
                <!-- <div class="media-body mt-75 ml-1">
                  <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                  <input type="file" id="account-upload" hidden accept="image/*" />
                  <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                  <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                </div> -->
                <!--/ upload and reset button -->


                
              </div>
              <!--/ header media -->

              <!-- form -->
              <form class="validate-form mt-2" method="post" action="{{ route('Sentry.update', $sentry->id) }}">
              @method('PATCH') 
              @csrf  
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-username">Full Nmaes</label>
                      <input type="text" class="form-control"  name="name" value="{{ $sentry ->name }}"  />

                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-name">Phone Number</label>
                      <input type="text" class="form-control"  name="phone_number" value="{{ $sentry ->phone_number }}"  />

                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                                        <fieldset class="form-group">
                                          <label  for="user-role">Premise Name</label>
                                          <select  name="premise_id" class="form-control">
                                          <option  value="{{ $sentry ->premise_id }}" > Select ...</option>
                                            @foreach ($premises as $prem)
                                                <option  value="{{ $prem ->id }}"> {{ $prem ->name }}</option>
                                            @endforeach  
                                          </select>
                                        </fieldset>
                                        </div>

                    <div class="col-12 col-sm-6">
                                        <fieldset class="form-group">
                                          <label  for="user-role">Work Shift</label>
                                          <select  name="shift_id" class="form-control">
                                          <option  value="{{ $sentry ->shift_id }}" > Select ...</option>
                                            @foreach ($shifts as $shift)
                                                <option  value="{{ $shift ->id }}"> {{ $shift ->name }}</option>
                                            @endforeach  
                                          </select>
                                        </fieldset>
                                        </div>
                  <!-- <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-e-mail">E-mail</label>
                      <input type="text" class="form-control"  name="email" >

                    </div>
                  </div> -->
                  <!-- <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-company">Company</label>
                      <input type="text" class="form-control" value="DeveInt Limited" />
                    </div>
                  </div> -->
                  <div class="col-12 mt-75">
                    <div class="alert alert-warning mb-50" role="alert">
                      <h4 class="alert-heading">Your email is not vailable.</h4>
                   
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-2 mr-1">Update</button>
                    <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                  </div>
                </div>
              </form>
              <!--/ form -->
            </div>
            <!--/ general tab -->

       
            <!-- information -->
            <div
              class="tab-pane fade"
              id="account-vertical-info"
              role="tabpanel"
              aria-labelledby="account-pill-info"
              aria-expanded="false"
            >
              <!-- form -->
              <form class="validate-form">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="accountTextarea">Bio</label>
                      <textarea
                        class="form-control"
                        id="accountTextarea"
                        rows="4"
                        placeholder="Your Bio data here..."
                      ></textarea>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-birth-date">Birth date</label>
                      <input
                        type="text"
                        class="form-control flatpickr"
                        placeholder="Birth date"
                        id="account-birth-date"
                        name="dob"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="accountSelect">Country</label>
                      <select class="form-control" id="accountSelect">
                        <option>USA</option>
                        <option>India</option>
                        <option>Canada</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-website">Website</label>
                      <input
                        type="text"
                        class="form-control"
                        name="website"
                        id="account-website"
                        placeholder="Website address"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-phone">Phone</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-phone"
                        placeholder="Phone number"
                        value="(+656) 254 2568"
                        name="phone"
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-1 mr-1">Save changes</button>
                    <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                  </div>
                </div>
              </form>
              <!--/ form -->
            </div>
            <!--/ information -->

          
        

           
          </div>
        </div>
      </div>
    </div>
    <!--/ right content section -->
  </div>
</section>
<!-- / account setting page -->
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/page-account-settings.js')) }}"></script>
@endsection