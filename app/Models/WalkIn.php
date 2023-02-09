<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WalkIn extends Model
{
    use HasFactory;
    protected $table = 'visitors';
    protected $guarded = [];

    public function organization(): HasMany
    {
        return $this->hasMany(Organization::class, 'id', 'organizationId');
    }
    public function visitorType() {
        return $this->belongsTo(VisitorType::class);
    }
}
