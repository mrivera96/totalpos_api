<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->increments('id');
            $table->double('discount')->nullable();
            $table->integer('quantity');
            $table->float('unit_price');
            $table->integer('purchase_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('tax_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('purchase_details', function (Blueprint $table){
           $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('purchase_details');
    }
}
