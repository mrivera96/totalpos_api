<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'users';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'birthday',
        'register_date',
        'mobile',
        'address',
        'email',
        'password',
        'username',
        'role_id',
        'branch_id',
        'status'
    ];

    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
}
