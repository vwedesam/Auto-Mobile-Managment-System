<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
    public function product()
    {
    	return $this->hasMany(Product::class);
    }

    public function sales_invoice()
    {
    	return $this->hasMany(SalesInvoice::class);
    }

}
