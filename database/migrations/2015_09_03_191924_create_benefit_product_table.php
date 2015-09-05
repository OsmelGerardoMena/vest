<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBenefitProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefit_product', function(Blueprint $table){
            $table->increments('id');
            $table->string('value');
            
            //Relationships
            $table->integer('benefit_id')->unsigned();
            $table->foreign('benefit_id')->references('id')->on('benefits')
                    ->onDelete('cascade');
                    
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
        Schema::drop('benefit_product');
    }
}
