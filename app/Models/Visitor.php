<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Organization;
use App\Models\Premise;
use App\Models\VehicleInformation;
use App\Models\Nationality;
use App\Models\Tag;

class Visitor extends Model
{
    protected $table = 'visitors';
    protected $guarded = [];
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organizationId');
    }

    public function premises(): BelongsTo
    {
        return $this->belongsTo(Premise::class, 'premisesId');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(VehicleInformation::class, 'vehicleId');
    }

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
