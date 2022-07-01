<?php

namespace Database\Seeders;

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
        $this->call(RegionTableSeeder::class);
        $this->call(SektorTableSeeder::class);
        $this->call(RezultatTableSeeder::class);
        $this->call(VrstaObukeTableSeeder::class);
        $this->call(PredavacTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
        $this->call(RolaTableSeeder::class);
        $this->call(SluzbaTableSeeder::class);
        $this->call(PrakticnaOcjenaTableSeeder::class);
    }
}
