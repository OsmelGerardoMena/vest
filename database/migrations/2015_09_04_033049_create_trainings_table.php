<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function(Blueprint $table){
            $table->increments('id');
            $table->date('date')->nullable();
            $table->text('content');
            $table->string('training_file')->nullable();
            
            //Relationships
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')
                    ->onDelete('cascade');

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
        Schema::drop('trainings');
    }
}
