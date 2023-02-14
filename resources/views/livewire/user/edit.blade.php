
@extends('layouts/contentLayoutMaster')

@section('content')

<!-- Tooltip validations start -->
<section class="tooltip-validations" id="tooltip-validation">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit User</h4>
        </div>
        <div class="card-body">
   
          <form class="needs-validation" novalidate>
            <div class="form-row">
              <div class="col-md-4 col-12 mb-3">
                <label for="validationTooltip01">Full Names</label>
                <input
                  type="text"
                  class="form-control"
                  id="validationTooltip01"
                  placeholder=""
                  value="{{ $data[0]->name }}"
                  required
                />
              
              </div>
              <div class="col-md-4 col-12 mb-3">
                <label for="validationTooltip02">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="validationTooltip02"
                  value="{{ $data[0]->email }}"
                  required
                />
              
              </div>
              <div class="col-md-4 col-12 mb-3">
                <label for="validationTooltip03">Phone Number</label>
                <input type="text" class="form-control" id="validationTooltip03" value="{{ $data[0]->phone_number }}" required />

              </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Tooltip validations end -->
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-tooltip-valid.js')) }}"></script>
@endsection