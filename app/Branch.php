<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branchs';
    public $timestamps = false;
    protected $fillable =['branch_name',
        'branch_description',
        'branch_register_date',
        'branch_register_number',
        'branch_address',
        'branch_open_hour',
        'branch_close_hour'
        ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
