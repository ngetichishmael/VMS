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
        return $this->belongsTo(Organization::class, 'organization_id');
    }

//    public function premises(): BelongsTo
//    {
//        return $this->belongsTo(Premise::class, 'premises_id');
//    }
    public function purpose(): BelongsTo
    {
        return $this->belongsTo(Purpose::class, 'purpose_id');
    }
    public function timeLogs():BelongsTo
    {
        return $this->belongsTo(TimeLog::class, 'time_log_id', 'id');
    }

    public function visitorsVisits()
    {
        return $this->belongsTo(TimeLog::class, 'id');
    }
    public function createdBy():HasOneOrMany
    {
        return $this->hasMany(Sentry::class, 'id', 'sentry_id' );
    }
    public function vehicle(): HasOne
    {
        return $this->hasOne(VehicleInformation::class );
    }


//    public function tag(): BelongsTo
//    {
//        return $this->belongsTo(Tag::class, 'tagId');
//    }
    public function visitorType(): BelongsTo
    {
        return $this->belongsTo(VisitorType::class, 'visitor_type_id');
    }
    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'id', 'resident_id');
    }
    public function resident2(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

}
