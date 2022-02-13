<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMake extends Model
{
    
    protected $table = 'makes';

    protected $fillable = ['name', 'product_id'];

    public $timestamps = false;

    public function products()
    {
        
        return $this->hasMany(Product::class);

    }

    public function product()
    {
    	
    	return $this->belongsTo(ProductName::class);

    }

    public function model()
    {
    	return $this->hasMany(ProductModel::class);
    }
    
}
