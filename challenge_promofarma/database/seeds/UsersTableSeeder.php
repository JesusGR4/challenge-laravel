<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Usuario 1',
            'email' => 'jesgarrio@gmail.com',
            'password' => bcrypt('asdfasdf'),
            'status' => true
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Usuario 2',
            'email' => 'jesus.garcia@pcrg.eu',
            'password' => bcrypt('asdfasdf'),
            'status' => true
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Usuario 3',
            'email' => 'jesus.garcia@miscota.com',
            'password' => bcrypt('asdfasdf'),
            'status' => false
        ]);
    }
}
