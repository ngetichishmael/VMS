<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $guarded=[''];
    public function fields()
    {
        return $this->belongsTo(Setting::class, 'field_id', 'id');
    }
}
