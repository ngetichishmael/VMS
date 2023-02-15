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
    protected $guarded=[];
//    public function organization(): HasMany
//    {
//        return $this->hasMany(WalkIn::class, 'organization_id', 'organization_id');
//    }
//    public function dorganization(): HasMany
//    {
//        return $this->hasMany(DriveIn::class, 'organization_id', 'organization_id');
//    }
}


// {
//     use HasFactory;
// }
