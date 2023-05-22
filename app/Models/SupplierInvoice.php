<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierInvoice extends Model
{
    use HasFactory;

    use SoftDeletes;
       const UNPAID = 1;
    const PAID = 2;
    const PARTIALLY_PAYED = 3;
    const RETURNED = 4;
    const PARTIALLY_RETURNED = 5;

    public function label()
    {
        return match($this->gender)
        {
            self::UNPAID => 'غير مدفوع',
            self::PAID => 'مدفوع',
            self::PARTIALLY_PAYED => 'مدفوع جزئيا',
            self::RETURNED => 'مرتجع',
            self::PARTIALLY_RETURNED => '  مرتجع جزئي',
            default => 'unknown',
        };
    }

    public static function getStatus(){
        return [
                self::UNPAID,
                self::PAID,
                self::PARTIALLY_PAYED,
                self::RETURNED,
                self::PARTIALLY_RETURNED,
            ];
    }

    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }


    public function products()
    {
        return $this->belongsToMany('App\Models\Product','product_supplier_invoice')->withTimestamps()->withPivot('qty','id','product_price','total','status');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User')->where('roles_name','["supplier"]');
    }

    public function outcome()
    {
        return $this->morphOne('App\Models\Outcome', 'outcomable');
    }
}


