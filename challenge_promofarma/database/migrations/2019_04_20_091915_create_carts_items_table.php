<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_items', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cart');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_seller');
            $table->integer('quantity');
            $table->float('amount');
            $table->boolean('status');
            $table->primary(array('id_cart', 'id_product', 'id_seller'));
            $table->foreign('id_cart')->references('id_cart')->on('carts');
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
        Schema::dropIfExists('carts');
    }
}
