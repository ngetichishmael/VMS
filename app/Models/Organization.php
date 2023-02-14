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
        return $this->hasMany(Organization::class, 'organization_id', 'organization_id');
    }


}


// {
//     use HasFactory;
// }
