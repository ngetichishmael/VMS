<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DriveInController;
use App\Http\Controllers\IdentificationTypeController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PremiseController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\SentryController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceNameController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleInformationController;
use App\Http\Controllers\Visit\AllCheckinsController;
use App\Http\Controllers\Visit\IDCheckinsController;
use App\Http\Controllers\Visit\iPassCheckinsController;
use App\Http\Controllers\Visit\SmsCheckinsController;
use App\Http\Controllers\WalkInController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'validOTP'])->group(function () {
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

    Route::resource('service/information', ServiceNameController::class)->names([
        'index' => 'ServiceName',
        'show' => 'ServiceName.show',
        'edit' => 'ServiceName.edit',
        'update' => 'ServiceName.update',
        'destroy' => 'ServiceName.destroy',
        'create' => 'ServiceName.create',
        'store' => 'ServiceName.store',
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
        'index' => 'Shifts',
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
        'deactivate' => 'OrganizationInformation.deactivate',
    ]);
    Route::resource('organization/setting', SettingController::class)->names([
        'index' => 'OrganizationSetting',
        'show' => 'OrganizationSetting.show',
        'edit' => 'OrganizationSetting.edit',
        'update' => 'OrganizationSetting.update',
        'destroy' => 'OrganizationSetting.destroy',
        'create' => 'OrganizationSetting.create',
        'store' => 'OrganizationSetting.store',
        'deactivate' => 'OrganizationSetting.deactivate',
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
    Route::resource('Visits/SMSCheckIn', SmsCheckinsController::class)->names([
        'index' => 'VisitSMSCheckIn',
        'show' => 'VisitSMSCheckIn.show',
        'edit' => 'VisitSMSCheckIn.edit',
        'update' => 'VisitSMSCheckIn.update',
        'destroy' => 'VisitSMSCheckIn.destroy',
        'create' => 'VisitSMSCheckIn.create',
        'store' => 'VisitSMSCheckIn.store',
    ]);
    Route::resource('Visits/IDCheckIn', IDCheckinsController::class)->names([
        'index' => 'VisitIDCheckIn',
        'show' => 'VisitIDCheckIn.show',
        'edit' => 'VisitIDCheckIn.edit',
        'update' => 'VisitIDCheckIn.update',
        'destroy' => 'VisitIDCheckIn.destroy',
        'create' => 'VisitIDCheckIn.create',
        'store' => 'VisitIDCheckIn.store',
    ]);
    Route::resource('Visits/IPassCheckIn', iPassCheckinsController::class)->names([
        'index' => 'VisitIPassCheckIn',
        'show' => 'VisitIPassCheckIn.show',
        'edit' => 'VisitIPassCheckIn.edit',
        'update' => 'VisitIPassCheckIn.update',
        'destroy' => 'VisitIPassCheckIn.destroy',
        'create' => 'VisitIPassCheckIn.create',
        'store' => 'VisitIPassCheckIn.store',
    ]);
    Route::resource('Visits/AllCheckIn', AllCheckinsController::class)->names([
        'index' => 'VisitAllCheckIn',
        'show' => 'VisitAllCheckIn.show',
    ]);
    Route::resource('logs/activities', ActivityController::class)->names([
        'index' => 'activity',
        'show' => 'activity.show',
    ]);
    Route::put('Visits/AllCheckIn/{visitor}', 'AllCheckinsController@update')->name('VisitAllCheckIn.update');

});
