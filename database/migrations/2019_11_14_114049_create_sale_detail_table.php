<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->double('discount')->nullable();
            $table->integer('quantity');
            $table->double('unit_price');
            $table->integer('sale_id')->unsigned();
            $table->integer('product_id')->nullable()->unsigned();
            $table->integer('service_id')->nullable()->unsigned();
            $table->integer('tax_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('sale_detail', function (Blueprint $table){
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_detail');
    }
}
