<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SektorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sektor')->insert([
            [
                'naziv' => 'Sektor za mjerenje',
            ],
            [
                'naziv' => 'Sektor za upravljanje mrežom',
            ],
            [
                'naziv' => 'Sektor za održavanje',
            ]
        ]);
    }
}
