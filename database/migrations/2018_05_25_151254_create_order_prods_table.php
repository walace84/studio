<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_prods', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price', 6, 2)->default(0);
            $table->decimal('discount', 6, 2);
            $table->String('product');
            $table->integer('points')->unsigned();
            $table->enum('status', ['RE', 'PA', 'CA']);
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('order_prods');
    }
}
