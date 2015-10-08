<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount', 10, 2);
            
            //Relationships
            $table->integer('seller_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('users')
                    ->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')
                    ->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')
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
        Schema::drop('sales');
    }
}
