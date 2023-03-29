<?php

namespace App\Models;

use App\Models\Organization;
use App\Models\Premise;
use App\Models\Tag;
use App\Models\TimeLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\VehicleInformation;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
        return $this->hasOne(TimeLog::class,'id','time_log_id')->latest();
    }
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_code', 'code');
    }

    public function premises()
    {
        return $this->hasMany(Premise::class, );
    }
    public function user(): HasMany
    {
        return $this->hasMany(User::class, );
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, );
    }
    public function purpose()
    {
        return $this->hasMany(Purpose::class, );
    }
    public function organization1()
    {
        return $this->hasMany(Organization::class );
    }

    public function visitorType(): BelongsTo
    {
        return $this->belongsTo(VisitorType::class, 'visitor_type_id');
    }
    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class,'id','time_log_id');
    }
    public function Resident():BelongsTo
    {
        return $this->belongsTo(Resident::class);
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

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->orWhere('visitors.name', 'like', '%'.$searchTerm.'%')
                ->orWhereHas('vehicle', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('registration', 'like', '%'.$searchTerm.'%');
                })
                ->orWhereHas('resident', function ($subQuery) use ($searchTerm) {
                    $subQuery->whereHas('unit', function ($subSubQuery) use ($searchTerm) {
                        $subSubQuery->whereHas('block', function ($subSubSubQuery) use ($searchTerm) {
                            $subSubSubQuery->whereHas('premise', function ($subSubSubSubQuery) use ($searchTerm) {
                                $subSubSubSubQuery->whereHas('organization', function ($subSubSubSubSubQuery) use ($searchTerm) {
                                    $subSubSubSubSubQuery->where('resident.name', 'like', '%'.$searchTerm.'%');
                                });
                            });
                        });
                    });
                });
        });
    }

}
