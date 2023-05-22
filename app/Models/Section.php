<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];

    public function suppliers()
    {
        return $this->hasMany('App\Models\User')->where('roles_name','["supplier"]');
    }

        public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

     public function clients()
    {
        return $this->hasMany('App\Models\User');
    }


}
