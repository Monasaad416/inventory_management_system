<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable =['details','amount'];


      public function outcome()
    {
        return $this->morphOne('App\Models\Outcome', 'outcomable');
    }
}
