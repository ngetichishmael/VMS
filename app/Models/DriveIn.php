<?php

namespace App\Models;

use App\Models\Organization;
use App\Models\Premise;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Vehicle;
use App\Models\TimeLog;


class DriveIn extends Model
{
    use HasFactory;
    protected $table = 'visitors';
    protected $guarded = [];

    public function dorganization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
    public function vehicle(): BelongsTo
    {
        return $this->BelongsTo(VehicleInformation::class, 'id', 'visitor_id');
    }
//    public function visitorType() {
//        return $this->belongsTo(VisitorType::class);
//    }
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function premises(): BelongsTo
    {
        return $this->belongsTo(Premise::class, 'premises_id');
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
