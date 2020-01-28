<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(BranchsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}
