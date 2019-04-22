<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('products')->insert([
            'name' => 'Producto 1',
            'status' => true
        ]);

        \Illuminate\Support\Facades\DB::table('products')->insert([
            'name' => 'Producto 2',
            'status' => true
        ]);

        \Illuminate\Support\Facades\DB::table('products')->insert([
            'name' => 'Producto 3',
            'status' => true
        ]);
    }
}
