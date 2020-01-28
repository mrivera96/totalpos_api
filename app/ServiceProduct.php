<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProduct extends Model
{
    protected $table = 'service_product';
    public $timestamps = false;


    public function Service(){
        return $this->belongsTo(Service::class);
    }
}
