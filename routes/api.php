<?php


use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\Visitors\DriveInController;
use App\Http\Controllers\Api\Visitors\SmsCheckInController;
use App\Http\Controllers\Api\Visitors\WalkInController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\SMSCheckingController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Visitors\VisitorController;
use Illuminate\Support\Facades\Route;



//visitor walkin,drivein apis



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthenticationController::class, 'Login']);
Route::group(['namespace' => 'Api'], function () {

    Route::post('verify/otp/{number}/{otp}', [AuthenticationController::class, 'verifyOTP']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('verify/settings', [AuthenticationController::class, 'settings']);
        Route::get('verify/fields', [AuthenticationController::class, 'fields']);
        Route::post('phone-number/{phone_number}', [SMSCheckingController::class, 'SMSChecking']);
        Route::post('verify/otp/{otp}', [SMSCheckingController::class, 'verifyOTP']);
        Route::get('visitors/my_all', [VisitorController::class, 'index']);
        Route::get('visitors/visitor/{id}', [DriveInController::class, 'show']);
        Route::get('visitors/organization-options', [VisitorController::class, 'organizationOptions']);
        Route::get('visitors/identification-options', [VisitorController::class, 'identificationOptions']);
        Route::get('visitors/premises-options', [VisitorController::class, 'premisesOptions']);
        Route::get('visitors/purpose-options', [VisitorController::class, 'purposeOptions']);
        Route::get('visitors/host-options', [VisitorController::class, 'hostOptions']);
        Route::get('visitors/destination-options', [VisitorController::class, 'unitOptions']);
        Route::get('visitors/visitortype-options', [VisitorController::class, 'visitorTypeOptions']);
        Route::get('visitors/drivein/all', [DriveInController::class, 'index']);
        Route::post('visitors/drivein/create', [DriveInController::class, 'store']);
        Route::get('visitors/smsCheckin/all', [SmsCheckInController::class, 'index']);
        Route::get('visitors/smsCheckin/smsUncheckout', [SmsCheckInController::class, 'smsUncheckout']);
        Route::put('visitors/smsCheckout', [SmsCheckInController::class, 'smsCheckout']);
        Route::post('visitors/smsCheckin/create', [SmsCheckInController::class, 'store']);
        Route::get('visitors/walkin/all', [WalkInController::class, 'index']);
        Route::post('visitors/walkin/create', [WalkInController::class, 'store']);

        Route::post('visitors/verify_checkout', [VisitorController::class, 'verifyUser']);
        Route::put('visitors/checkout', [VisitorController::class, 'checkout'])->name('api.visitors.checkout');

        Route::post('visitors/verify_returning_visitor', [VisitorController::class, 'returningVisitorVerify']);
        Route::put('visitors/checkin_returning_visitor', [VisitorController::class, 'store'])->name('api.visitors.store');

        Route::post('visitors/device', [DeviceController::class, 'store']);
        Route::get('visitors/device/all', [DeviceController::class, 'store']);
    });
});
