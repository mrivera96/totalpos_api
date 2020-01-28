<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['description',
        'barcode',
        'cost',
        'sale_price',
        'in_stock',
        'brand',
        'supplier_id',
        'product_category_id',
        'status'];

    protected $hidden = ['created_at','updated_at'];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

}
