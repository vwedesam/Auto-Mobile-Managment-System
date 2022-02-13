<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    
    protected $table = 'sales_invoice';

   // Relationship
    public function product_sales_invoice()
    {
    	return $this->hasMany(ProductSalesInvoice::class);
    }

    public function miscellaneous_sales()
    {
        return $this->hasMany(Miscellaneous_sales::class);
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
    	return $this->hasMany(Product::class);
    }

    // Accessor
    public function getNewDateFormatAttribute($value)
    {

        return date('M, d Y', strtotime($this->created_at));
 
    }


}
