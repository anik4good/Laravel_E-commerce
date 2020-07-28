<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Admin->(Anik)',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Author->(Author1)',
            'username' => 'author',
            'email' => 'author@gmail.com',
            'password' => bcrypt('123456'),
        ]);


    }
}
