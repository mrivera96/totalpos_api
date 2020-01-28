<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchs', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 100);
			$table->string('description',100);
            $table->integer('cellphone_number');
            $table->integer('phone_number');
			$table->date('register_date');
			$table->string('register_number',14);
			$table->string('address',100);
			$table->char('open_hour');
			$table->char('close_hour');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branchs');
    }
}
