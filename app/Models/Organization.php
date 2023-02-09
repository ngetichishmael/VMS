<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;
    protected $guarded;
    public function organization(): HasMany
    {
        return $this->hasMany(WalkIn::class, 'organizationId', 'organizationId');
    }
    public function dorganization(): HasMany
    {
        return $this->hasMany(DriveIn::class, 'organizationId', 'organizationId');
    }
}
