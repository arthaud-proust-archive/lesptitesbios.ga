<?php

use Illuminate\Database\Seeder;

class TrashTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trash')->insert([
            'type' => 'person',
            'slug' => 'charles-baudelaire',
            'name' => 'Charles Baudelaire',
            'state' => 'writing',
            'date' => '1821-1867',
            'img' => Str::random(20),
            'bio' => Str::random(20),
            'notes' => null,
        ]);
    }
}
