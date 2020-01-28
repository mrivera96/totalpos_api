<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::insert([
        ['description'  =>  'Administrador'],
        ['description'  =>  'Cajero'],
        ['description'  =>  'Vendedor'],
      ]);
    }
}
