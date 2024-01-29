
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

<img src="{{ asset('images/logo/infoseclogo.png') }}" alt="INFOSEC" style="width: 180px; height: 80px;">



            </a>

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
                <h3 class="card-title font-weight-bold mb-1">Welcome to INFOSEC <b> GUARD</b>!</h3>
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
                        <div class="col-md-6" style="padding:10px">
                            <button type="submit" class="btn btn-primary btn-block" tabindex="4">Verify</button>
                        </div>
                        <div class="col-md-6" style="padding:10px">
                            <button id="resendButton" onclick="resend()"  type="button" class="btn btn-primary btn-block" tabindex="4" disabled>Resend</button>
                        </div>

                    </div>
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

<script>
    var countdownSeconds = 60;
    var interval;

    function startTimer() {
        var button = document.getElementById('resendButton');

        // Disable the button initially
        button.disabled = true;

        interval = setInterval(function() {
            // Update the button text with the remaining seconds
            button.innerHTML = 'Resend (' + countdownSeconds + 's)';

            if (countdownSeconds === 0) {
                // Enable the button after the countdown
                button.disabled = false;
                button.innerHTML = 'Resend';
                clearInterval(interval);
            }

            countdownSeconds--;
        }, 1000);
    }
    // // Countdown timer in seconds
    // var countdownSeconds = 60;
    //
    // function startTimer() {
    //     var button = document.getElementById('resendButton');
    //
    //     // Disable the button initially
    //     button.disabled = true;
    //
    //     var interval = setInterval(function() {
    //         // Update the button text with the remaining seconds
    //         button.innerHTML  = 'Resend (' + countdownSeconds + 's)';
    //
    //         if (countdownSeconds === 0) {
    //             // Enable the button after the countdown
    //             button.disabled = false;
    //             button.innerHTML  = 'Resend';
    //             clearInterval(interval);
    //         }
    //
    //         countdownSeconds--;
    //     }, 1000);
    // }
    function resend() {
        var button = document.getElementById('resendButton');
        button.disabled = true;
        var url = "{{ route('login') }}";
        axios.post(url)
            .then(function(response) {
                countdownSeconds = 60;
                startTimer();
            })
            .catch(function(error) {
                button.disabled = false;
            });
    }

    // Start the timer when the page loads
    window.onload = startTimer;
</script>

@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/pages/page-auth-login.js')) }}"></script>
@endsection

