<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RezultatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rezultat')->insert([
            [
                'naziv' => 'Uspješno',
            ],
            [
                'naziv' => 'Neuspješno',
            ]
        ]);
    }
}
