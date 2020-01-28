<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    public $timestamps = false;
    protected $fillable = [
    	'name',
		'description',
		'phone_number',
		'email', 
		'address',
		'status'
	];
	
	public function products(){
		return $this->hasMany(Product::class);
	}
}
