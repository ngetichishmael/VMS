<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resident extends Model
{
    use HasFactory;
    protected $table='residents';
    protected $guarded=[];
    /**
     * Get the Unit that owns the Resident
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function premise(): BelongsTo
    {
        return $this->unit->block->premise;
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function user_detail()
    {
        return $this->belongsTo(UserDetail::class, 'user_detail_id');
    }
    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
