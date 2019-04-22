<?php

use Illuminate\Database\Seeder;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('sellers')->insert([
            'name' => 'Seller 1',
            'status' => true
        ]);

        \Illuminate\Support\Facades\DB::table('sellers')->insert([
            'name' => 'Seller 2',
            'status' => true
        ]);

        \Illuminate\Support\Facades\DB::table('sellers')->insert([
            'name' => 'Seller 3',
            'status' => true
        ]);
    }
}
