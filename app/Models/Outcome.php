<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;

     protected $fillable = ['outcomable', 'amount','details'];

    public function outcomable()
    {
        return $this->morphTo();
    }

}
