<?php

use Illuminate\Database\Seeder;
use App\Branch;
use Carbon\Carbon;


class BranchsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = new Branch();
        $branch->name   =   'SMARTEC DANLÍ';
        $branch->description =   'Sucursal Principal';
        $branch->cellphone_number    =   32558085;
        $branch->phone_number        =   27223628;
        $branch->register_date       =   Carbon::now();
        $branch->register_number     =   '07032001000902';
        $branch->address             =   'Barrio Abajo contiguo a Cargo Expreso, Danlí, El Paraíso';
        $branch->open_hour           =   '8:00';
        $branch->close_hour          =   '17:30';
        $branch->save();

    }
}
