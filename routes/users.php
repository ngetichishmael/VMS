<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DriveInController;
use App\Http\Controllers\IdentificationTypeController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PremiseController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\SentryController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleInformationController;
use App\Http\Controllers\WalkInController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::resource('bookings', BookingController::class)->names([
        'index' => 'bookings',
        'show' => 'bookings.show',
        'edit' => 'bookings.edit',
        'update' => 'bookings.update',
        'destroy' => 'bookings.destroy',
        'create' => 'bookings.create',
        'store' => 'bookings.store',
    ]);
    Route::resource('service/category', ServiceCategoryController::class)->names([
        'index' => 'ServiceCategory',
        'show' => 'ServiceCategory.show',
        'edit' => 'ServiceCategory.edit',
        'update' => 'ServiceCategory.update',
        'destroy' => 'ServiceCategory.destroy',
        'create' => 'ServiceCategory.create',
        'store' => 'ServiceCategory.store',
    ]);
    Route::resource('users/sentries', SentryController::class)->names([
        'index' => 'Sentry',
        'show' => 'Sentry.show',
        'edit' => 'Sentry.edit',
        'update' => 'Sentry.update',
        'destroy' => 'Sentry.destroy',
        'create' => 'Sentry.create',
        'store' => 'Sentry.store',
    ]);
    Route::resource('organization/users', UserController::class)->names([
        'index' => 'OrganizationUsers',
        'show' => 'OrganizationUsers.show',
        'edit' => 'OrganizationUsers.edit',
        'update' => 'OrganizationUsers.update',
        'destroy' => 'OrganizationUsers.destroy',
        'create' => 'OrganizationUsers.create',
        'store' => 'OrganizationUsers.store',
        'status_update' => 'OrganizationUsers.suspend/{id}',

    ]);



    Route::resource('shifts', ShiftController::class)->names([
        'index' => 'shifts',
        'show' => 'shifts.show',
        'edit' => 'shifts.edit',
        'update' => 'shifts.update',
        'destroy' => 'shifts.destroy',
        'create' => 'shifts.create',
        'store' => 'shifts.store',
    ]);
    Route::resource('identification/type', IdentificationTypeController::class)->names([
        'index' => 'IdentificationType',
        'show' => 'IdentificationType.show',
        'edit' => 'IdentificationType.edit',
        'update' => 'IdentificationType.update',
        'destroy' => 'IdentificationType.destroy',
        'create' => 'IdentificationType.create',
        'store' => 'IdentificationType.store',
    ]);
    Route::resource('vehicle/information', VehicleInformationController::class)->names([
        'index' => 'VehicleInformation',
        'show' => 'VehicleInformation.show',
        'edit' => 'VehicleInformation.edit',
        'update' => 'VehicleInformation.update',
        'destroy' => 'VehicleInformation.destroy',
        'create' => 'VehicleInformation.create',
        'store' => 'VehicleInformation.store',
    ]);


    Route::resource('organization/information', OrganizationController::class)->names([
        'index' => 'OrganizationInformation',
        'show' => 'OrganizationInformation.show',
        'edit' => 'OrganizationInformation.edit',
        'update' => 'OrganizationInformation.update',
        'destroy' => 'OrganizationInformation.destroy',
        'create' => 'OrganizationInformation.create',
        'store' => 'OrganizationInformation.store',
     
    ]);


    Route::resource('premise/information', PremiseController::class)->names([
        'index' => 'PremiseInformation',
        'show' => 'PremiseInformation.show',
        'edit' => 'PremiseInformation.edit',
        'update' => 'PremiseInformation.update',
        'destroy' => 'PremiseInformation.destroy',
        'create' => 'PremiseInformation.create',
        'store' => 'PremiseInformation.store',
    ]);
    Route::resource('block/information', BlockController::class)->names([
        'index' => 'BlockInformation',
        'show' => 'BlockInformation.show',
        'edit' => 'BlockInformation.edit',
        'update' => 'BlockInformation.update',
        'destroy' => 'BlockInformation.destroy',
        'create' => 'BlockInformation.create',
        'store' => 'BlockInformation.store',
    ]);
    Route::resource('unit/information', UnitController::class)->names([
        'index' => 'UnitInformation',
        'show' => 'UnitInformation.show',
        'edit' => 'UnitInformation.edit',
        'update' => 'UnitInformation.update',
        'destroy' => 'UnitInformation.destroy',
        'create' => 'UnitInformation.create',
        'store' => 'UnitInformation.store',
    ]);
    Route::resource('resident/information', ResidentController::class)->names([
        'index' => 'ResidentInformation',
        'show' => 'ResidentInformation.show',
        'edit' => 'ResidentInformation.edit',
        'update' => 'ResidentInformation.update',
        'destroy' => 'ResidentInformation.destroy',
        'create' => 'ResidentInformation.create',
        'store' => 'ResidentInformation.store',
    ]);
    Route::resource('Visits/DriveIn', DriveInController::class)->names([
        'index' => 'VisitDriveIn',
        'show' => 'VisitDriveIn.show',
        'edit' => 'VisitDriveIn.edit',
        'update' => 'VisitDriveIn.update',
        'destroy' => 'VisitDriveIn.destroy',
        'create' => 'VisitDriveIn.create',
        'store' => 'VisitDriveIn.store',
    ]);
    Route::resource('Visits/WalkIn', WalkInController::class)->names([
        'index' => 'VisitWalkIn',
        'show' => 'VisitWalkIn.show',
        'edit' => 'VisitWalkIn.edit',
        'update' => 'VisitWalkIn.update',
        'destroy' => 'VisitWalkIn.destroy',
        'create' => 'VisitWalkIn.create',
        'store' => 'VisitWalkIn.store',
    ]);
});


// // users
// Route::get('/search',[UserController::class,'search']);
// Route::get('organization/users/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth');
// Route::get('organization/users/edit/{id}}', [App\Http\Controllers\UserController::class, 'editt'])->middleware('auth');
// Route::get('organization/users/suspend/{id}',[App\Http\Controllers\UserController::class, 'status_update'])->middleware('auth');


// // organizations
// Route::get('/search',[OrganizationController::class,'search']);
// Route::get('organization/information/delete/{id}', [App\Http\Controllers\OrganizationController::class, 'destroy'])->middleware('auth');
// Route::get('organization/information/suspend/{id}',[App\Http\Controllers\OrganizationController::class, 'status_update'])->middleware('auth');

// // Premises
// Route::get('/search',[PremiseController::class,'search']);
// Route::get('premise/information/delete/{id}', [App\Http\Controllers\PremiseController::class, 'destroy'])->middleware('auth');
// Route::get('premise/information/{id}}', [App\Http\Controllers\PremiseController::class, 'edit'])->middleware('auth');
// Route::get('premise/information/suspend/{id}',[App\Http\Controllers\PremiseController::class, 'status_update'])->middleware('auth');

// // Blocks
// Route::get('/search',[BlockController::class,'search']);
// Route::get('block/information/delete/{id}', [App\Http\Controllers\BlockController::class, 'destroy'])->middleware('auth');
// Route::get('block/information/{id}}', [App\Http\Controllers\BlockController::class, 'edit'])->middleware('auth');
// Route::get('block/information/suspend/{id}',[App\Http\Controllers\BlockController::class, 'status_update'])->middleware('auth');

// // Units
// Route::get('/search',[UnitController::class,'search']);
// Route::get('unit/information/delete/{id}', [App\Http\Controllers\UnitController::class, 'destroy'])->middleware('auth');
// Route::get('unit/information/{id}}', [App\Http\Controllers\UnitController::class, 'edit'])->middleware('auth');
// Route::get('unit/information/suspend/{id}',[App\Http\Controllers\UnitController::class, 'status_update'])->middleware('auth');

// // Residents
// Route::get('/search',[ResidentController::class,'search']);
// Route::get('resident/information/delete/{id}', [App\Http\Controllers\ResidentController::class, 'destroy'])->middleware('auth');
// Route::get('resident/information/{id}}', [App\Http\Controllers\ResidentController::class, 'edit'])->middleware('auth');
// Route::get('resident/information/suspend/{id}',[App\Http\Controllers\ResidentController::class, 'status_update'])->middleware('auth');



// // Sentries
// Route::get('/search',[SentryController::class,'search']);
// Route::get('users/sentries/delete/{id}', [App\Http\Controllers\SentryController::class, 'destroy'])->middleware('auth');
// Route::get('users/sentries/{id}}', [App\Http\Controllers\SentryController::class, 'edit'])->middleware('auth');
// Route::get('users/sentries/suspend/{id}',[App\Http\Controllers\SentryController::class, 'status_update'])->middleware('auth');



// // Sservice category
// Route::get('/search',[ServiceCategoryController::class,'search']);
// Route::get('service/category/delete/{id}', [App\Http\Controllers\ServiceCategoryController::class, 'destroy'])->middleware('auth');
// Route::get('service/category/{id}}', [App\Http\Controllers\ServiceCategoryController::class, 'edit'])->middleware('auth');
// Route::get('service/category/suspend/{id}',[App\Http\Controllers\ServiceCategoryController::class, 'status_update'])->middleware('auth');
