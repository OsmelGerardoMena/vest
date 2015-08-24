<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmodulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submodules', function(Blueprint $table){
            $table->increments('id');
            $table->string('description');
            $table->string('url')->default('#');
            $table->integer('order');

            //Relationships
            $table->integer('modules_id')->unsigned();
            $table->foreign('modules_id')->references('id')->on('modules')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('submodules');
    }
}
