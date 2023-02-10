<?php

use Illuminate\Http\Controllers\Api\Visitors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//api/v1
//Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\Visitors'], function(){
//Route::apiResource('visitor', VisitorsController::class);
//Route::apiResource('visitor/index', VisitorsController::class);
//Route::apiResource('drivein',DriveInController::class);
//});
//Route::apiResource('visitors', 'Api\Visitors\VisitorController');
Route::namespace('Api\Visitors')->group(function () {
    Route::resource('visitors', 'VisitorController');
});
Route::get('visitors/organization-options', 'Api\Visitors\VisitorController@organizationOptions');
Route::get('visitors/premises-options', 'Api\Visitors\VisitorController@premisesOptions');
Route::get('visitors/vehicle-options', 'Api\Visitors\VisitorController@vehicleOptions');
Route::get('visitors/nationality-options', 'Api\Visitors\VisitorController@nationalityOptions');
Route::get('visitors/tag-options', 'Api\Visitors\VisitorController@tagOptions');



//Route::get('visitors', 'VisitorController@index');
//Route::post('visitors', 'VisitorController@store');
//Route::get('visitors/{visitor}', 'VisitorController@show');
