<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_code', 'code');
    }
    public function fields()
    {
        return $this->hasOne(Field::class, 'field_id', 'id');
    }
}
