<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function visitorType() {
        return $this->belongsTo(VisitorType::class);
    }
}
