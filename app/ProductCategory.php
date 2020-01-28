<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $fillable = ['description'];
    public $timestamps = false;
    
    public function products(){
        return $this->hasMany(Product::class);
    }
}
