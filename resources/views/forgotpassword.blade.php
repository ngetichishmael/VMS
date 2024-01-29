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

<img src="{{ asset('images/logo/infoseclogo.png') }}" alt="INFOSEC" style="width: 180px; height: 60px;">



            </a>
            <!-- /Brand logo-->

            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                @if($configData['theme'] === 'dark')
                <img class="img-fluid" src="{{asset('images/pages/forgot-password-v2-dark.svg')}}" alt="Forgot password V2" />
                @else
                <img class="img-fluid" src="{{asset('images/pages/forgot-password-v2.svg')}}" alt="Forgot password V2" />
                @endif
                </div>
            </div>
            <!-- /Left Text-->
            <!-- Login-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">

                    <h2 class="card-title font-weight-bold mb-1">Forgot your Password? 🔒</h2>
                    <p class="card-text mb-2"> Simply enter the email address associated with your account and we’ll send you an email with instructions on how to reset your password.</p>

                    @if(session('message'))

                            <span class="help-block @if(session('status')) text-success @else text-danger @endif">
                                <strong>{{ session('message') }}</strong>
                            </span>

                    @endif



                    <form class="auth-login-form mt-2" action="{{ route('Forgot.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" type="text" name="email"
                                placeholder="vms@deveint.com" aria-describedby="login-email" autofocus=""
                                tabindex="1" />
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" tabindex="4">Submit</button>


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
