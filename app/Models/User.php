<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

use Kyslik\ColumnSortable\Sortable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;

    protected $table = 'users';
    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
