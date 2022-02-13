<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    //
    protected $table = 'models';

    protected $fillable = ['name', 'make_id'];

    public $timestamps = false;

    public function products()
    {
        
        return $this->hasMany(Product::class);

    }

    public function make()
    {
    	return $this->belongsTo(ProductMake::class);
    }

}
