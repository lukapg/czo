<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VrstaObukeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vrsta_obuke')->insert([
            [
                'sluzba_id' => '1',
                'naziv' => 'Obuka u službi za mjerenje',
            ],
            [
                'sluzba_id' => '5',
                'naziv' => 'Obuka za uklopničare',
            ],
            [
                'sluzba_id' => '8',
                'naziv' => 'Obuka u službi za održavanje - Elektroenergetski vodovi i stubna trafostanica',
            ],
            [
                'sluzba_id' => '8',
                'naziv' => 'Visokonaponska razvodna postrojenja, elektroenergetski kablovski vodovi i energetski transformatori',
            ],
            [
                'sluzba_id' => '8',
                'naziv' => 'Nadzemni vodovi 35kV',
            ],
            [
                'sluzba_id' => '8',
                'naziv' => 'Tehnika relejne zastite, Ispitivanja kablovskih vodova, ispitivanja ET',
            ]
        ]);
    }
}
