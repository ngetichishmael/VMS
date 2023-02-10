<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Organization;
use App\Models\Premise;
use App\Models\Vehicle;
use App\Models\Nationality;
use App\Models\Tag;

class Visitor extends Model
{
    protected $table = 'visitors';
    protected $guarded = [];
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organizationId');
    }

    public function premise()
    {
        return $this->belongsTo(Premise::class, 'premisesId');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicleId');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationalityId');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tagId');
    }
}
