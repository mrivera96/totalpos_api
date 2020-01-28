<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivableAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivable_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->char('type');
            $table->double('amount');
            $table->integer('sale_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('receivable_accounts', function (Blueprint $table){
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receivable_accounts');
    }
}
