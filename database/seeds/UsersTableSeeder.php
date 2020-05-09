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
        DB::table('users')->insert([
            'name' => 'admin',
            'level' => '3',
            'contact' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'level' => '0',
            'contact' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
