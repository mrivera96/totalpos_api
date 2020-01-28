<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('last_name', 45);
            $table->string('username', 15)->unique();
            $table->string('avatar')->nullable();
            $table->string('dni',13)->unique();
            $table->date('birthday');
            $table->dateTime('register_date');
            $table->bigInteger('mobile')->unique();
            $table->string('address',100);
            $table->string('email',100)->unique();
            $table->string('password',255);
            $table->tinyInteger('status')->default(1);
            $table->integer('role_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->rememberToken();
        });

        Schema::table('users', function (Blueprint $table){
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('branch_id')->references('id')->on('branchs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
