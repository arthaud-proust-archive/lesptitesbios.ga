<?php

use Illuminate\Database\Seeder;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persons')->insert([
            'slug' => 'charles-baudelaire',
            'name' => 'Charles Baudelaire',
            'classrooms' => '["1°11"]',
            'state' => 'writing',
            'date' => '1821-1867',
            'img' => Str::random(20),
            'bio' => Str::random(20),
            'notes' => Str::random(20),
        ]);
    }
}
