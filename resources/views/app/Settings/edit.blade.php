@extends('layouts.contentLayoutMaster')

@section('title', 'Subscription  Settings')

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
           .card-container {
            padding-top: 20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            background-color:#F2F3F5;
        }
        .card-left {
            padding: 10px;
            width: 55%;
            height: 25%;
            background-color:#E5E4E2;

        }
        .card-right {
            padding: 10px;
            width: 42%;

            background-color:#E5E4E2;

        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('OrganizationSetting.update', ['setting' => $organization_code->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
<div class="tab-content">
    <!-- Account Tab starts -->
    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
        <form class="form-validate">
            <div class="row">
                <div class="col-12" style=" display: flex; flex-wrap: wrap;">

                    <div class="mt-1 border rounded table-responsive">
                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                            <span class="align-middle">Setting on <strong>{!! $organization_code->organization->name !!} </strong>  subscriptions </span>
                        </h6>
                        <div class="card-container">
                            <div class="card-left">
                                <div class="card">
                        <table class="table table-striped table-borderless">
                            <thead class="thead-light">
                            <tr>
                                <th>Module</th>
                                <th>Settings </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Verified ID Check-in</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="admin-read" name="id_checkin"
                                               @if ($organization_code->id_checkin === 1) checked @endif
 />
                                        <label class="custom-control-label"
                                               for="admin-read"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>iPass Check-in</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="staff-read" name="ipass_checkin"
                                               @if ($organization_code->ipass_checkin === 1) checked @endif

                                        />
                                        <label class="custom-control-label"
                                               for="staff-read"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Automatic Check-in</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="author-read" name="automatic_id_checkin"

                                               @if ($organization_code->automatic_id_checkin === 1) checked @endif
                                        />
                                        <label class="custom-control-label"
                                               for="author-read"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>SMS Check-in </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="contributor-read" name="sms_checkin"

                                               @if ($organization_code->sms_checkin === 1) checked @endif
                                        />
                                        <label class="custom-control-label"
                                               for="contributor-read"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Returning Visitor</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="returning_visitor" name="returning_visitor"

                                               @if ($organization_code->returning_visitor === 1) checked @endif
                                        />
                                        <label class="custom-control-label"
                                               for="returning_visitor"></label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                            </div>
                        </div>

                            <div class="card-right">
                                <div class="card">
                                    <table class="table table-striped table-borderless">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Field Name </th>
                                            <th>Display or Hide </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Visitor Type</td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="visitor_type" name="visitor_type"
                                                           @if ($fields->visitor_type === 1) checked @endif />
                                                    <label class="custom-control-label"
                                                           for="visitor_type"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Destination</td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="destination" name="destination"
                                                           @if ($fields->destination === 1) checked @endif

                                                    />
                                                    <label class="custom-control-label"
                                                           for="destination"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tag</td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="tag" name="tag"

                                                           @if ($fields->tag === 1) checked @endif
                                                    />
                                                    <label class="custom-control-label"
                                                           for="tag"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Host </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="host" name="host"

                                                           @if ($fields->host === 1) checked @endif
                                                    />
                                                    <label class="custom-control-label"
                                                           for="host"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Purpose of Visit</td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="purpose" name="purpose_of_visit"

                                                           @if ($fields->purpose_of_visit === 1) checked @endif
                                                    />
                                                    <label class="custom-control-label"
                                                           for="purpose"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Attachments </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="attachments" name="attachments"

                                                           @if ($fields->attachments === 1) checked @endif
                                                    />
                                                    <label class="custom-control-label"
                                                           for="attachments"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gender </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="gender" name="gender"

                                                           @if ($fields->gender === 1) checked @endif
                                                    />
                                                    <label class="custom-control-label"
                                                           for="gender"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Company </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="company" name="company"

                                                           @if ($fields->company === 1) checked @endif
                                                    />
                                                    <label class="custom-control-label"
                                                           for="company"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Enable Fingure Print in Mobile</td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="fingerprint" name="fingerprint"

                                                           @if ($fields->fingerprint === 1) checked @endif
                                                    />
                                                    <label class="custom-control-label"
                                                           for="fingerprint"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                <div class="mt-2 col-12 d-flex flex-sm-row flex-column" style="gap: 20px;">
                    <button type="submit" class="mb-1 mr-0 btn btn-primary mb-sm-0 mr-sm-1">Update</button>
                    <a href="{{ route('OrganizationSetting') }}" type="reset"
                       class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
        <!-- users edit account form ends -->
    </div>
    <!-- Account Tab ends -->
</div></div></div>
                    </form>
                </div>
            </div>
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
