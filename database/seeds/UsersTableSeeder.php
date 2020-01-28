<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use App\Role;
use App\Branch;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      User::insert([
        ['name'             =>   'Super',
            'last_name'     =>   'Admin',
            'username'      =>   'admin',
            'avatar'        =>   'avatar5.png',
            'dni'           =>   '0703199076139',
            'birthday'      =>   Carbon::create(1996,11, 29),
            'register_date' =>   Carbon::now(),
            'mobile'        =>   31257901,
            'address'       =>   'Bo. Abajo',
            'email'         =>   'admin@smartec.com',
            'password'      =>   bcrypt('admin19'),
            'role_id'       =>   1,
            'branch_id'     =>   1,
            'status'        =>   1,
        ],
        ['name'             =>  'Salesman1',
            'last_name'     =>  'salesman',
            'username'      =>  'salesman',
            'avatar'        =>  'avatar3.png',
            'dni'           =>  '0703199307904',
            'birthday'      =>  Carbon::create(1996,11, 29),
            'register_date' =>  Carbon::now(),
            'mobile'        =>  98989898,
            'address'       =>  'Bo. Barrio abajo',
            'email'         =>  'salesman@smartec.com',
            'password'      =>  bcrypt('salesman19'),
            'role_id'       =>  3,
            'branch_id'     =>  1,
            'status'        =>  1,
        ]
      ]);
        

    }
}
