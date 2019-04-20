<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_items', function (Blueprint $table) {
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_seller');
            $table->unsignedBigInteger('id_product');
            $table->float('amount');
            $table->float('cost');
            $table->integer('quantity');
            $table->primary(array('id_order', 'id_seller', 'id_product'));
            $table->foreign('id_order')->references('id_order')->on('orders');
            $table->foreign('id_seller')->references('id_seller')->on('sellers');
            $table->foreign('id_product')->references('id_product')->on('products');
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
        Schema::dropIfExists('orders_items');
    }
}
