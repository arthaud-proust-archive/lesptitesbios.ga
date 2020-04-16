<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PersonsTableSeeder::class);
        $this->call(ArtworksTableSeeder::class);
        $this->call(TrashTableSeeder::class);
        $this->call(IntroTableSeeder::class);
    }
}
