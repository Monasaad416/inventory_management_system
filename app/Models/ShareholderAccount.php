<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareholderAccount extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];

    function shareholder()
    {
        return $this->belongsTo('App\Models\User');
    }

         function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
