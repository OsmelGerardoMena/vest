<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncentivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incentives', function(Blueprint $table){
            $table->increments('id');
            $table->double('goal', 10, 2);
            $table->string('award');
            $table->string('img');
            $table->date('date_from');
            $table->date('date_to');
            
            //Relationships
            $table->integer('incentive_type_id')->unsigned();
            $table->foreign('incentive_type_id')->references('id')->on('incentive_types');

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
        Schema::drop('incentives');
    }
}
