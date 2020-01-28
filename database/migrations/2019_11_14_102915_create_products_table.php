<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description', 100);
            $table->string('barcode')->unique();
            $table->double('cost');
            $table->double('sale_price');
            $table->integer('in_stock');
            $table->string('brand', 100);
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('supplier_id')->unsigned();
            $table->integer('product_category_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('products', function(Blueprint $table){
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
