<?php

namespace App\Models;

use App\Models\Nationality;
use App\Models\Organization;
use App\Models\Premise;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Vehicle;


class DriveIn extends Model
{
    use HasFactory;
    protected $table = 'visitors';
    protected $guarded = [];

    public function dorganization(): HasMany
    {
        return $this->hasMany(Organization::class, 'id', 'organizationId');
    }
    public function vehicle(): BelongsTo
    {
        return $this->BelongsTo(VehicleInformation::class, 'vehicleId', 'id');
    }
//    public function visitorType() {
//        return $this->belongsTo(VisitorType::class);
//    }
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organizationId');
    }

    public function premises(): BelongsTo
    {
        return $this->belongsTo(Premise::class, 'premisesId');
    }

//    public function vehicle(): BelongsTo
//    {
//        return $this->belongsTo(VehicleInformation::class, 'vehicleId');
//    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'nationalityId');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tagId');
    }
    public function visitorType(): BelongsTo
    {
        return $this->belongsTo(VisitorType::class, 'visitorTypeId');
    }
}
