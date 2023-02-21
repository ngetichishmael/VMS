<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $table = 'blocks';
    protected $guarded = [];

    public function premise()
    {
        return $this->belongsTo(Premise::class, 'premise_id');
    }

}
