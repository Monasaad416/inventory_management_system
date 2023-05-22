<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $guarded =['id','created_at','updated_at'];

    public function supplier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
