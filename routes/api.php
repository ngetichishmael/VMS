<?php


use App\Http\Controllers\Api\Visitors\DriveInController;
use App\Http\Controllers\Api\Visitors\WalkInController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Visitors\VisitorController;
use Illuminate\Support\Facades\Route;



//visitor walkin,drivein apis
Route::group(['namespace' => 'App\Http\Controllers\Api\Visitors'], function () {

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('login',  'AuthController@userLogin');
    Route::post('signup', 'AuthController@userSignUp');

    Route::prefix('visitors')->group(function () {
        Route::get('/all', [VisitorController::class,'index']);
        Route::get('visitor/{id}', [DriveInController::class,'show']);
        Route::get('organization-options', [VisitorController::class, 'organizationOptions']);
        Route::get('premises-options', [VisitorController::class,'premisesOptions']);
        Route::get('purpose-options', [VisitorController::class,'purposeOptions']);
        Route::get('tag-options', [VisitorController::class,'tagOptions']);

        Route::get('/drivein/all', [DriveInController::class,'index']);
        Route::post('/drivein/create', [DriveInController::class,'store']);

        Route::get('/walkin/all', [WalkInController::class,'index']);
        Route::post('/walkin/create', [WalkInController::class,'store']);
    });
});
Route::post('/login',  [AuthenticationController::class, 'login']);

