<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSalesInvoice extends Model
{
    protected $table = 'product_sales_invoice';

    public function sales_invoice()
    {
    	return $this->belongsTo(SalesInvoice::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    
    // Accessor
    public function getNewDateFormatAttribute($value)
    {

        return date('d, M Y', strtotime($this->created_at));
 
    }


}
