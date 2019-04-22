<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Order 1
        \Illuminate\Support\Facades\DB::table('orders')->insert([
            'id_order' => 1,
            'id_user' => 1,
        ]);

        // Order items for Order 1

        \Illuminate\Support\Facades\DB::table('orders_items')->insert([
            'id_order' => 1,
            'id_product' => 1,
            'id_seller' =>1,
            'amount' => 9.0,
            'cost' => 8.0,
            'quantity' => 3
        ]);

        \Illuminate\Support\Facades\DB::table('orders_items')->insert([
            'id_order' => 1,
            'id_product' => 2,
            'id_seller' =>2,
            'amount' => 12.0,
            'cost' => 8.0,
            'quantity' => 2
        ]);

        // Order 2
        \Illuminate\Support\Facades\DB::table('orders')->insert([
            'id_order' => 2,
            'id_user' => 1,
        ]);


        // Order items for Order 2

        \Illuminate\Support\Facades\DB::table('orders_items')->insert([
            'id_order' => 2,
            'id_product' => 3,
            'id_seller' =>3,
            'amount' => 15,
            'cost' => 10.0,
            'quantity' => 2
        ]);

        // Order 3
        \Illuminate\Support\Facades\DB::table('orders')->insert([
            'id_order' => 3,
            'id_user' => 2,
        ]);


        \Illuminate\Support\Facades\DB::table('orders_items')->insert([
            'id_order' => 3,
            'id_product' => 1,
            'id_seller' =>1,
            'amount' => 9.0,
            'cost' => 8.0,
            'quantity' => 4
        ]);

        \Illuminate\Support\Facades\DB::table('orders_items')->insert([
            'id_order' => 3,
            'id_product' => 2,
            'id_seller' =>2,
            'amount' => 12.0,
            'cost' => 8.0,
            'quantity' => 1
        ]);

        // Order 4
        \Illuminate\Support\Facades\DB::table('orders')->insert([
            'id_order' => 4,
            'id_user' => 3,
        ]);


        // Order items for Order 2

        \Illuminate\Support\Facades\DB::table('orders_items')->insert([
            'id_order' => 4,
            'id_product' => 3,
            'id_seller' =>3,
            'amount' => 15,
            'cost' => 10.0,
            'quantity' => 2
        ]);
    }
}
