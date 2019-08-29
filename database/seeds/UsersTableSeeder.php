<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin account
        DB::table('users')->insert([
            'name' => 'adminer',
            'email' => 'adminer@example.com',
            'password' => bcrypt('adminer'),
            'level' => 1,
            'status' => 1,
        ]);

        // User account
        DB::table('users')->insert([
            'name' => 'userlogin',
            'email' => 'userlogin@example.com',
            'password' => bcrypt('userlogin'),
            'level' => 2,
            'status' => 1,
        ]);
    }
}
