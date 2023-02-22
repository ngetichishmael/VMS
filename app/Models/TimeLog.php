<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    use HasFactory;

    /**
     * @var mixed|string
     */
    protected $table='time_logs';
    protected $guarded=[];
    public function visitor()
    {
        return $this->hasMany(Visitor::class, );
    }
    public function drivein()
    {
        return $this->hasMany(DriveIn::class, 'time_log_id');
    }
}
