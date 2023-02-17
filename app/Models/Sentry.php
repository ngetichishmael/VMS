<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sentry extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function createdBy():BelongsTo
    {
        return $this->belongsTo(Visitor::class, 'id', 'sentry_id');
    }
}
