<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
      protected $guarded =['id','created_at','updated_at'];



    public function shareholders()
    {
        return $this->hasMany('App\Models\User');
    }


    function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function clientInvoices()
    {
        return $this->hasMany('App\Models\ClientInvoice');
    }


    public function supplierInvoices()
    {
        return $this->hasMany('App\Models\SupplierInvoice');
    }

    public function outcome()
    {
        return $this->morphOne('App\Models\Outcome', 'outcomable');
    }


    public function expenses()
    {
        return $this->hasMany('App\Models\SupplierExpense');
    }



    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
      protected $casts = [
        'email_verified_at' => 'datetime',
         'roles_name' => 'array',
    ];

}
