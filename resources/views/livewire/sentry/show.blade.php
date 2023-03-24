@extends('layouts/contentLayoutMaster')

@section('title', 'Guard View')

@section('vendor-style')
<link rel="stylesheet" href="{{asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css'))}}">
<link rel="stylesheet" href="{{asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css'))}}">
<link rel="stylesheet" href="{{asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css'))}}">
@endsection
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-user.css')) }}">
@endsection


@section('content')
    @php
        use Carbon\Carbon;
    @endphp
<section class="app-user-view">
  <!-- User Card & Plan Starts -->
  <div class="row">
    <!-- User Card starts-->
    <div class="col-xl-9 col-lg-8 col-md-7">
      <div class="card user-card">
        <div class="card-body">
          <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">

            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">

                  <div class="d-flex flex-column ml-1">
                    <div class="user-info mb-1">
                      <h4 class="mb-0">Name : {{ $sentry->name }}</h4>
                    </div>

                    <div class="card">
                    <h5 class="mb-1">Shift
              <span class="badge badge-light-secondary">{{ $sentry->shift->name }} <span class="nextYear"></span>
          </span>
        </h5>

        </div>
                    <div class="card">
                    <h5 class="mb-1">Premises
              <span class="badge badge-light-secondary">{{ $premises->name }} <span class="nextYear"></span>
          </span>
        </h5>

        </div>
                    <div class="card">
                    <h5 class="mb-1">Organization
              <span class="badge badge-light-secondary">{{ $organization->name }} <span class="nextYear"></span>
          </span>
        </h5>

        </div>


                  </div>

                </div>
              </div>

            </div>
            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
              <div class="user-info-wrapper">
                <div class="d-flex flex-wrap">
                  <div class="user-info-title">
                    <i data-feather="user" class="mr-1"></i>
                    <span class="card-text user-info-title font-weight-bold mb-0">Full Names</span>
                  </div>
                  <p class="card-text mb-0">{{ $sentry->name }}</p>
                </div>
                <div class="d-flex flex-wrap my-50">
                  <div class="user-info-title">
                    <i data-feather="check" class="mr-1"></i>
                    <span class="card-text user-info-title font-weight-bold mb-0">Status</span>
                  </div>

                    <?php if($sentry->status == '1'){ ?>
                                             <span class="badge badge-pill badge-light-success mr-1">Active</span>

                                     <?php }else{ ?>
                                             <span class="badge badge-pill badge-light-warning mr-1">Disabled</span>

                                      <?php } ?>


                </div>
                <div class="d-flex flex-wrap my-50">
                  <div class="user-info-title">
                    <i data-feather="star" class="mr-1"></i>
                    <span class="card-text user-info-title font-weight-bold mb-0">Role</span>
                  </div>
                  <p class="card-text mb-0">Guard</p>
                </div>
                <div class="d-flex flex-wrap my-50">
                  <div class="user-info-title">
                    <i data-feather="flag" class="mr-1"></i>
                    <span class="card-text user-info-title font-weight-bold mb-0">Country</span>
                  </div>
                  <p class="card-text mb-0">Kenya</p>
                </div>


                <div class="d-flex flex-wrap">
                  <div class="user-info-title">
                    <i data-feather="phone" class="mr-1"></i>
                    <span class="card-text user-info-title font-weight-bold mb-0">Contact</span>
                  </div>
                  <p class="card-text mb-0"> {{ $sentry->phone_number }} </p>
                </div>
                  <hr/></br>


                <div class="d-flex flex-wrap">
                    <div class="user-info-title">
                        <i data-feather="cell-phone" class="mr-1"></i>
                        <span class="card-text user-info-title font-weight-bold mb-0"><strong>Device</strong></span>
                    </div>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="user-info-title">
                        <i data-feather="imei" class="mr-1"></i>
                        <span class="card-text user-info-title font-weight-bold mb-0">IMEI</span>
                    </div>
                    <p class="card-text mb-0"> {{ $device->identifier ?? 'NA' }} </p>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="user-info-title">
                        <i data-feather="latitude" class="mr-1"></i>
                        <span class="card-text user-info-title font-weight-bold mb-0">Latitude</span>
                    </div>
                    <p class="card-text mb-0"> {{ $device->latitude ?? 'NA'}} </p>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="user-info-title">
                        <i data-feather="longitude" class="mr-1"></i>
                        <span class="card-text user-info-title font-weight-bold mb-0">Longitude</span>
                    </div>
                    <p class="card-text mb-0"> {{ $device->longitude  ?? 'NA'}} </p>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="user-info-title">
                        <i data-feather="address" class="mr-1"></i>
                        <span class="card-text user-info-title font-weight-bold mb-0">Address Name</span>
                    </div>
                    <p class="card-text mb-0"> {{ $device->name_of_address ?? 'NA'}} </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /User Card Ends-->
  </div>




  <div class="card col-9">
      <div class="card-body">
          <h5 class="card-title" style="color: #1f8af5">Guard Activity Logs</h5>
          <div class="row col-12">
              <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                      <tr>
                          <th>Created At</th>
                          <th>Activity</th>
                      </tr>
                      </thead>
                      <tbody>
                      @forelse ($activities as $key => $activity)
                          <tr>
                              <td>{!! $activity->created_at ?? now() !!}</td>
                              <td>{{$activity->activity }}</td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="6" style="text-align: center;"> No Record Found </td>
                          </tr>
                      @endforelse
                      </tbody>
                  </table>
                  <div style="margin-left: 5%" class="mt-1">
              {{ $activities->links('pagination::bootstrap-4') }}


                  </div>
              </div>
          </div>

{{--</div> <div class="card col-9">--}}
{{--  <div class="card-body">--}}
{{--    <h5 class="card-title" style="color: #1f8af5">Visitor History</h5>--}}
{{--    <div class="row col-12">--}}
{{--        <div class="table-responsive">--}}

{{--            <table class="table table-hover">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Name</th>--}}
{{--                    <th>Type</th>--}}
{{--                    <th>Date</th>--}}
{{--                    <th>Time In</th>--}}
{{--                    <th>Time Out</th>--}}
{{--                    <th>Duration</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @forelse ($visitors as $visitor)--}}
{{--                    @forelse ($visitor->timeLogs as $timeLog)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $visitor->name ?? 'NA' }}</td>--}}
{{--                            <td>{{ $visitor->type ?? 'NA' }}</td>--}}
{{--                            <td>{{ $timeLog->entry_time ? Carbon::parse($timeLog->entry_time)->format('m/d/Y') : '-' }}</td>--}}
{{--                            <td>{{ $timeLog->entry_time ? Carbon::parse($timeLog->entry_time)->format('h:i A') : '-' }}</td>--}}
{{--                            <td>{{ $timeLog->exit_time ? Carbon::parse($timeLog->exit_time)->format('h:i A') : '-' }}</td>--}}
{{--                            <td>{!! Carbon::parse($timeLog->entry_time ?? now())->diff(Carbon::parse($timeLog->exit_time ?? now()))->format('%H Hours %I Minutes %S Seconds') !!}</td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="6" style="text-align: center;"> No Record Found </td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
{{--                @empty--}}
{{--                    <tr>--}}
{{--                        <td colspan="6" style="text-align: center;"> No Record Found </td>--}}
{{--                    </tr>--}}
{{--                @endforelse--}}

{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--</div>--}}


<div class="d-flex flex-wrap">
     <a href="{{url('/users/sentries')}}" style="margin-left: 85%;" class="btn btn-primary"> Back </a>
</div>



</div>



</section>

@endsection


@section('vendor-script')
{{-- vendor files --}}
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
@endsection
