<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefits', function(Blueprint $table){
            $table->increments('id');
            $table->double('amount', 10, 2);
            
            //Relationships
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('benefit_types');
            
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
        Schema::drop('benefits');
    }
}
