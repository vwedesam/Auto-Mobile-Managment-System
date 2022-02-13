<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductName extends Model
{
    protected $table = 'product_name';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function products()
    {
        
        return $this->hasMany(Product::class);

    }

    public function make()
    {
    	
    	return $this->hasMany(ProductName::class);

    }

}
