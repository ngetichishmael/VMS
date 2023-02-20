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

  

}

