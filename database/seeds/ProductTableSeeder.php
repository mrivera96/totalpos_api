<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            ['name' => 'Bolígrafo',
            'description' => 'Bolígrafo neón',
            'barcode' => 'ABC-abc-1234',
            'cost' => 4.37,
            'sale_price'=> 7.50,
            'in_stock'=>100,
            'brand' => 'GENIAL',
            'image'=>'boli.png',
            'supplier_id' => 1,
            'product_category_id' => 1]
        ]);
    }
}
