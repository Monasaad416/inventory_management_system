<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ClientInvoice extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded =['id','created_at','updated_at','deleted_at'];

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
            self::PARTIALLY_RETURNED => 'مرتجع جزئي',
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


    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }


    public function products()
    {
        return $this->belongsToMany('App\Models\Product','client_invoice_product')->withTimestamps()->withPivot('qty','id','product_price','total','status','product_id','client_invoice_id');
    }




    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
