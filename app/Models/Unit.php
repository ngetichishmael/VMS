<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    protected $guarded = [];

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function premises()
    {
        return $this->block->premise();

    }
}
