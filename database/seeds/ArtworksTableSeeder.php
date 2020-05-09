<?php

use Illuminate\Database\Seeder;

class ArtworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artworks')->insert([
            'slug' => 'une-charogne',
            'name' => 'LA n°1 - Une charogne',
            'classrooms' => '["1°11"]',
            'state' => 'writing',
            'person' => 'Charles Baudelaire',
            'date' => '1857',
            'content' => Str::random(20),
            'text' => Str::random(20),
            'notes' => null,

        ]);
    }
}
