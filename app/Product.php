<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    protected $fillables = ['product_name_id', 'make_id', 'model_id', 'additional_info', 'quantity', 'cost', 'grn' ];

    public $timestamps = false;

    public function product_sales_invoice()
    {
        return $this->belongsToMany(ProductSalesInvoice::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product_name()
    {
    	return $this->belongsTo(ProductName::class);
    }

    public function make()
    {
    	return $this->belongsTo(ProductMake::class);
    }

    public function model()
    {
    	return $this->belongsTo(ProductModel::class);
    }

}
