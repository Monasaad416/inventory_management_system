<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Shareholder extends Authenticatable
{
    use HasFactory, HasRoles;
    protected $guard_name = 'shareholder';
    protected $guarded =['id','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name' => 'array',
    ];
}
