<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Admin account
        DB::table('users')->insert([
            'name' => 'adminer',
            'email' => 'adminer@example.com',
            'password' => bcrypt('adminer'),
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
            'level' => 1,
            'status' => 1,
        ]);

        // User account
        DB::table('users')->insert([
            'name' => 'userlogin',
            'email' => 'userlogin@example.com',
            'password' => bcrypt('userlogin'),
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
            'level' => 2,
            'status' => 1,
        ]);
    }
}
