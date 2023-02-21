<?php

namespace App\Models;

use App\Models\Organization;
use App\Models\Premise;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\VehicleInformation;
use App\Models\TimeLog;


class DriveIn extends Model
{
    use HasFactory;
    protected $table = 'visitors';
    protected $guarded = [];

    public function vehicle(): BelongsTo
    {
        return $this->BelongsTo(VehicleInformation::class, 'id', 'visitor_id');
    }
//    public function visitorType() {
//        return $this->belongsTo(VisitorType::class);
//    }
    public function timeLog()
    {
        return $this->belongsTo(TimeLog::class);
    }
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_code');
    }

    public function premises()
    {
        return $this->hasMany(Premise::class, 'id');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'id');
    }
    public function unit()
    {
        return $this->hasMany(Unit::class, 'id' );
    }
    public function purpose()
    {
        return $this->hasMany(Purpose::class, 'id');
    }
    public function organization1()
    {
        return $this->hasMany(\App\Models\Organization::class, 'id' );
    }

//    public function vehicle(): BelongsTo
//    {
//        return $this->belongsTo(VehicleInformation::class, 'vehicleId');
//    }

    public function visitorType(): BelongsTo
    {
        return $this->belongsTo(VisitorType::class, 'visitor_type_id');
    }
    public function timeLogs():BelongsTo
    {
        return $this->belongsTo(TimeLog::class, 'time_log_id');
    }
    public function Resident():BelongsTo
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
    public function user_details():BelongsTo
    {
        return $this->belongsTo(UserDetail::class, 'user_detail_id');
    }
    public function purpose1()
    {
        return $this->belongsTo(Purpose::class,'purpose_id');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    public function sentry(): BelongsTo
    {
        return $this->belongsTo(Sentry::class);
    }
}
