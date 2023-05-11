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

            <img src="{{ asset('images/logo/Mojaplus-logo_Primary-Logo.png') }}" alt="MojaPass" style="width: 200px; height: 60px;">



        </a>
        <!-- /Brand logo-->

        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">

                       <img class="img-fluid" src="{{ asset('images/pages/login-v2-dark.svg') }}" alt="Login V2" />

            </div>
        </div>
        <!-- /Left Text-->
        <!-- Login-->
        <!-- Login-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <h2 class="card-title font-weight-bold mb-1">Welcome to Moja<b>Pass</b>! 👋</h2>
                <p class="card-text mb-2">Enter the OTP Sent to your Email and Phone number</p>
                @if ($errors->has('otp'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('otp') }}</strong>
                </span>
                @endif
                <form class="auth-login-form mt-2" action="{{ route('otp.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="email">OTP</label>
                        <input class="form-control" id="otp" type="text" name="otp" placeholder="****" aria-describedby="login-email" autofocus="" tabindex="1" />
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block" tabindex="4">Verify</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('login')}}" type="reset" class="btn btn-primary btn-block" tabindex="4">Resend</a>
                        </div>
                    </div>
                </form>

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

