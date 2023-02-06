<?php

use App\Http\Controllers\Api\Visitors\VisitorsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
Route::group(['prefix' => 'v1', 'namespace' => 'Ap\Http\Controller\Api\V1'], function(){
Route::apiResource('visitor', VisitorsController::class);
Route::apiResource('drivein',DriveInController::class);
});
