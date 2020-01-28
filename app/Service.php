<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable =['description','image','sale_price'];
    public $timestamps = false;


    public function SaleDetail(){
        return $this->hasMany(ServiceProduct::class);
    }


}
