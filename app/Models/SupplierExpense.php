<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierExpense extends Model
{
    use HasFactory;
    protected $fillable =['details','amount','user_id'];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }




}
