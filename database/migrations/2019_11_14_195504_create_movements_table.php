<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->increments('id');
            $table->double('initial_balance');
            $table->double('final_balance');
            $table->dateTime('open_date');
            $table->dateTime('close_date');
            $table->tinyInteger('status');
            $table->integer('user_id')->unsigned();
            $table->integer('sale_id')->unsigned();
            $table->integer('purchase_id')->unsigned();
            $table->integer('expense_id')->unsigned();
            $table->integer('cash_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('movements', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('expense_id')->references('id')->on('expenses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cash_id')->references('id')->on('cashes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
}
