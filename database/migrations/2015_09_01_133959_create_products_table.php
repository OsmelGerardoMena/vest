<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            
            //Relationships
            $table->integer('company_id')->unsigned();
            $table->integer('creator_id')->unsigned();
            $table->integer('status_id')->unsigned()->default(1);
            
            $table->foreign('company_id')->references('id')->on('users')
                    ->onDelete('cascade');
            $table->foreign('creator_id')->references('id')->on('users');
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
        Schema::drop('products');
    }
}
