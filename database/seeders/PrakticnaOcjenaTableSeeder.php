<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrakticnaOcjenaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prakticna_ocjena')->insert([
            [
                'naziv' => 'Zadovoljio',
            ],
            [
                'naziv' => 'Nije zadovoljio'
            ]
        ]);
    }
}
