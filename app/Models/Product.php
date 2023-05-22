<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];
        public function supplierInvoices()
    {
        return $this->belongsToMany('App\Models\Product','product_supplier_invoice')->withTimestamps()->withPivot('qty','id','product_price','total','status');
    }



       public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

        public function clientInvoices()
    {
        return $this->belongsToMany('App\Models\Product','client_invoice_product')->withTimestamps()->withPivot('qty','id','product_price','total','status','product_id','client_invoice_id');
    }

    function clientReturnItem()
    {
        return $this->belongsTo('App\Models\ClientReturnItem');
    }

    function supplierReturnItem()
    {
        return $this->belongsTo('App\Models\SupplierReturnItem');
    }

}
