<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static whereLike(string[] $array, string $searchTerm)
 */
class VehicleInformation extends Model
{
    use HasFactory;
    protected $guarded;
    public function visitor()
    {
          return $this->belongsTo(Visitor::class, );
    }
}
