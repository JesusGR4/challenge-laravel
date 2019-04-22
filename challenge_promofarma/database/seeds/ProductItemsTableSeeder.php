<?php

use Illuminate\Database\Seeder;

class ProductItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Product 1
        \Illuminate\Support\Facades\DB::table('products_sellers')->insert([
            'id_product' => 1,
            'id_seller' => 1,
            'stock' => 10,
            'amount' => 9.0,
            'cost' => 8.0,
            'status' => true
        ]);

        \Illuminate\Support\Facades\DB::table('products_sellers')->insert([
            'id_product' => 1,
            'id_seller' => 2,
            'stock' => 0,
            'amount' => 8.0,
            'cost' => 7.0,
            'status' => true
        ]);

        \Illuminate\Support\Facades\DB::table('products_sellers')->insert([
            'id_product' => 1,
            'id_seller' => 3,
            'stock' => 10,
            'amount' => 6.0,
            'cost' => 5.0,
            'status' => false
        ]);

        // Product 2

        \Illuminate\Support\Facades\DB::table('products_sellers')->insert([
            'id_product' => 2,
            'id_seller' => 1,
            'stock' => 15,
            'amount' => 22.0,
            'cost' => 8.0,
            'status' => false
        ]);

        \Illuminate\Support\Facades\DB::table('products_sellers')->insert([
            'id_product' => 2,
            'id_seller' => 2,
            'stock' => 7,
            'amount' => 12.0,
            'cost' => 8.0,
            'status' => true
        ]);

        \Illuminate\Support\Facades\DB::table('products_sellers')->insert([
            'id_product' => 2,
            'id_seller' => 3,
            'stock' => 15,
            'amount' => 10.0,
            'cost' => 8.0,
            'status' => true
        ]);

        // Product 3

        \Illuminate\Support\Facades\DB::table('products_sellers')->insert([
            'id_product' => 3,
            'id_seller' => 1,
            'stock' => 15,
            'amount' => 22.0,
            'cost' => 8.0,
            'status' => false
        ]);

        \Illuminate\Support\Facades\DB::table('products_sellers')->insert([
            'id_product' => 3,
            'id_seller' => 2,
            'stock' => 7,
            'amount' => 12.0,
            'cost' => 8.0,
            'status' => true
        ]);

        \Illuminate\Support\Facades\DB::table('products_sellers')->insert([
            'id_product' => 3,
            'id_seller' => 3,
            'stock' => 15,
            'amount' => 10.0,
            'cost' => 8.0,
            'status' => true
        ]);

    }
}
