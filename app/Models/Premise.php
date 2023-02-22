<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Premise extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
    public function sentry()
    {
        return $this->hasMany(Sentry::class);
    }
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}
