<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['role_description'];
    protected $hidden = ['created_at','updated_at'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
