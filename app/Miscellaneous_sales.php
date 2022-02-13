<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miscellaneous_sales extends Model
{
    //

    protected $table = 'miscellaneous_sales';

    //public 

    public function miscellaneous()
    {
    	return $this->belongsTo(Miscellaneous::class, 'misc_id');
    }
 
     public function sales_invoice()
    {
    	return $this->belongsTo(SalesInvoice::class);
    }

}
