<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredavacTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('predavac')->insert([
            [
                'ime' => 'Marko',
                'prezime' => 'Marković',
            ],
            [
                'ime' => 'Janko',
                'prezime' => 'Janković'
            ],
            [
                'ime' => 'Petar',
                'prezime' => 'Petrović'
            ],
        ]);
    }
}
