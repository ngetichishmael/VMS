<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sentry extends Model
{
    use HasFactory;
    protected $table = 'sentries';
    protected $guarded = [];

    public function visitor()
    {

        return $this->belongsTo(Visitor::class);
    }
    public function user_detail()
    {
        return $this->belongsTo(UserDetail::class, 'user_detail_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');

    }
    public function premise():BelongsTo
    {
        return $this->belongsTo(Premise::class);
    }
}
