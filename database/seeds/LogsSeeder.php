<?php

use Illuminate\Database\Seeder;

class IntroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs')->insert([
            'action' => 'Delete',
            'user' => 'arthaud',
            'content' => Str::random(50),
        ]);
    }
}
