<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsSeller extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_sellers', function (Blueprint $table) {
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_seller');
            $table->integer('stock');
            $table->boolean('status');
            $table->float('amount');
            $table->float('cost');
            $table->primary(array('id_product', 'id_seller'));
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
        Schema::dropIfExists('products_sellers');
    }
}
