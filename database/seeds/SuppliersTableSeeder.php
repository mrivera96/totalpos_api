<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::insert([
            ['name'             =>  'ACOSA',
                'description'   =>  'Empresa Hondureña Lider en Venta de Accesorios para Computadoras,Telefonia, Producto de Oficina, Utiles Escolares y Hogar.'   ,
                'phone_number'  =>  '25801240',
                'email'         =>  'callcentercity@acosa.com.hn',
                'address'       =>  'Tegucigalpa, City Mall Segundo Nivel',
                'status'        =>  1],
            ['name'             =>  'Caribe Comp',
                'description'   =>  'Proveedor de repuestos de computadoras y equipos de oficina.'   ,
                'phone_number'  =>  '25585338',
                'email'         =>  'ventas@caribecomp.com',
                'address'       =>  'Boulevard Centroamerica, Tegucigalpa',
                'status'        =>  1],
        ]);
    }
}
