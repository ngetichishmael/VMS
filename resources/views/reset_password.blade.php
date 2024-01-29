<!-- <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}" />
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required autofocus />
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password">New Password</label>
        <input id="password" type="password" name="password" required />
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required />
    </div>
    <div>
        <button type="submit">Reset Password</button>
    </div>
</form> -->




@php
    $configData = Helper::applClasses();
@endphp
@extends('layouts.fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-v2">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" style="padding-left:30px;" href="javascript:void(0);">
            <img src="{{ asset('images/logo/infoseclogo.png') }}" alt="INFOSEC" style="width: 200px; height: 60px;">

            </a>
            <!-- /Brand logo-->

            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                @if($configData['theme'] === 'dark')
                <img src="{{asset('images/pages/reset-password-v2-dark.svg')}}" class="img-fluid" alt="Register V2" />
                @else
                <img src="{{asset('images/pages/reset-password-v2.svg')}}" class="img-fluid" alt="Register V2" />
                @endif
                </div>
            </div>
            <!-- /Left Text-->
            <!-- Login-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title font-weight-bold mb-1">Reset your Password 🔒</h2>
                    <p class="card-text mb-2"> Enter your new password below </p>
                    @error('email')
                        <span class="help-block">
                            <strong class="text-danger"> {{ $message }} </strong>
                        </span>
                    @enderror
                    @error('password')
                        <span class="help-block">
                            <strong class="text-danger"> {{ $message }} </strong>
                        </span>
                    @enderror
                    <form class="auth-login-form mt-2" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}" />
                        <input type="hidden" name="email" value="{{ $email }}" />
                        <!-- <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email"
                                placeholder="" aria-describedby="login-email" autofocus=""
                                tabindex="1" />
                        </div> -->
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="login-password">Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password" type="password"
                                    name="password" placeholder="" aria-describedby="password"
                                    tabindex="2" />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer">
                                        <i data-feather="eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="login-password">Confirm Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password_confirmation" type="password"
                                    name="password_confirmation" placeholder="" aria-describedby="password"
                                    tabindex="2" />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer">
                                        <i data-feather="eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" tabindex="4">Reset Password</button>
                    </form>

                    <p class="text-right mt-2">
                        <a href="{{ route('logout') }}">
                            <i data-feather="chevron-left"></i> Back to login
                        </a>
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/pages/page-auth-login.js')) }}"></script>
@endsection
