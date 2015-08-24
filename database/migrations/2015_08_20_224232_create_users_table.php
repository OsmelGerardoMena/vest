<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('identifier');
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('url')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            //Relationships
            $table->integer('type_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('user_types');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
