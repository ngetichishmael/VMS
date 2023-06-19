<?php

namespace App\Models;

use Database\Seeders\VisitorSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Organization;
use App\Models\Premise;
use App\Models\VehicleInformation;
use App\Models\Nationality;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed $timeLogs
 */
class Visitor extends Model
{
    protected $table = 'visitors';
    protected $guarded = [];
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_code', 'code');
    }
    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class,'id','time_log_id');
    }
    public function purpose(): BelongsTo
    {
        return $this->belongsTo(Purpose::class, 'purpose_id');
    }
//    public function timeLogs(): BelongsTo
//    {
//        return $this->belongsTo(TimeLog::class, 'time_log_id', 'id');
//    }
    public function timeLog()
    {
        return $this->belongsTo(TimeLog::class);
    }

    public function visitorsVisits()
    {
        return $this->belongsTo(TimeLog::class, 'id');
    }
    public function sentry(): BelongsTo
    {
        return $this->belongsTo(Sentry::class);
    }
    public function vehicle()
    {
        return $this->hasMany(VehicleInformation::class);
    }
    public function visitorType(): BelongsTo
    {
        return $this->belongsTo(VisitorType::class, 'visitor_type_id');
    }
    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class,  'resident_id', 'id');
    }
    public function userDetail()
    {
        return $this->belongsTo(UserDetail::class);
    }

    public function resident2(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
    public function user_details(): BelongsTo
    {
        return $this->belongsTo(UserDetail::class, 'user_detail_id');
    }
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->orWhere('name', 'like', '%'.$searchTerm.'%')
                ->orWhereHas('vehicle', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('registration', 'like', '%'.$searchTerm.'%');
                })
                ->orWhereHas('resident', function ($subQuery) use ($searchTerm) {
                    $subQuery->whereHas('unit', function ($subSubQuery) use ($searchTerm) {
                        $subSubQuery->whereHas('block', function ($subSubSubQuery) use ($searchTerm) {
                            $subSubSubQuery->whereHas('premise', function ($subSubSubSubQuery) use ($searchTerm) {
                                $subSubSubSubQuery->whereHas('organization', function ($subSubSubSubSubQuery) use ($searchTerm) {
                                    $subSubSubSubSubQuery->where('name', 'like', '%'.$searchTerm.'%');
                                });
                            });
                        });
                    });
                });
        });
    }
}
