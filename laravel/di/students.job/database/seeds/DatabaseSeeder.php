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
        
        $this->call(MakePlacesSeeder::class);
        $this->call(MakeFacultiesSeeder::class);
        $this->call(MakeGroupsSeeder::class);
        $this->call(MakeLessonsSeeder::class);
        $this->call(MakeUsersSeeder::class);
    }
}
