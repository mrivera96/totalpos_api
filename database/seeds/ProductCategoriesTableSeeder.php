<?php

use Illuminate\Database\Seeder;
use App\ProductCategory;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      ProductCategory::insert([
        ['description'   =>  'Papelería'],
        ['description'    =>  'Impresión']
      ]);

    }
}
