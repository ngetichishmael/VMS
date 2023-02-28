<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Premise extends Model
{
    use HasFactory;

    protected $table = 'premises';
    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_code','code');
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
