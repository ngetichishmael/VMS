<?php

namespace App\Models;

use App\Models\Organization;
use App\Models\Premise;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Tag;

class WalkIn extends Model
{
    use HasFactory;
    protected $table = 'visitors';
    protected $guarded = [];


//    public function visitorType() {
//        return $this->belongsTo(VisitorType::class);
//    }
    public function timeLog()
    {
        return $this->belongsTo(TimeLog::class);
    }
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function premises()
    {
        return $this->hasMany(Premise::class, 'id');
    }public function user(): \Illuminate\Database\Eloquent\Relations\HasMany
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



//    public function tag(): BelongsTo
//    {
//        return $this->belongsTo(Tag::class, 'tagId');
//    }
    public function visitorType(): BelongsTo
    {
        return $this->belongsTo(VisitorType::class, 'visitor_type_id');
    }
    public function identificationType(): BelongsTo
    {
        return $this->belongsTo(IdentificationType::class, 'identification_id');
    }
    public function timeLogs():BelongsTo
    {
        return $this->belongsTo(TimeLog::class, 'time_log_id');
    }
    public function Resident():BelongsTo
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
}
