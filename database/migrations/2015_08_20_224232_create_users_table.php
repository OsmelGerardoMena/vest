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
            $table->string('identifier')->unique();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->default('default.jpg');
            
            //Relationships
            $table->integer('type_id')->unsigned();
            $table->integer('status_id')->unsigned()->default(1);
            $table->integer('company_category_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('user_types');
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('company_category_id')->references('id')
                        ->on('company_categories');

            $table->rememberToken();
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
        Schema::drop('users');
    }
}
