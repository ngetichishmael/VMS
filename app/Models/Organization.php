<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @method static where(\Closure $param)
 */

class Organization extends Model

{
    use HasFactory;

    protected $table = 'organizations';
    protected $guarded = [];

    public function setting()
    {
        return $this->hasOne(Setting::class, 'organization_code');
    }
    public function premise()
    {
        return $this->hasMany(Premise::class, 'organization_code', 'code');
    }
    public function user()
    {
        return $this->hasMany(User::class, 'organization_code','code');
    }
}
