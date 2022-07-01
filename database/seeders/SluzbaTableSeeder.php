<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SluzbaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sluzba')->insert([
            [
                'sektor_id' => '1',
                'naziv' => 'Centar za mjerenje'
            ],
            [
                'sektor_id' => '1',
                'naziv' => 'Služba za AMM'
            ],
            [
                'sektor_id' => '1',
                'naziv' => 'Služba za kontrolu i monitoring'
            ],
            [
                'sektor_id' => '1',
                'naziv' => 'Služba za planiranje, analize i reklamacije'
            ],
            [
                'sektor_id' => '2',
                'naziv' => 'Centar za lokalno upravljanje mrežom'
            ],
            [
                'sektor_id' => '2',
                'naziv' => 'Služba za operativno upravljanje'
            ],
            [
                'sektor_id' => '2',
                'naziv' => 'Služba za operativnu energ. plan. i analizu rada mreže 35kV'
            ],
            [
                'sektor_id' => '3',
                'naziv' => 'Centar za održavanje 10kV i 0.4kV mreže'
            ],
            [
                'sektor_id' => '3',
                'naziv' => 'Služba za održavanje 35kV vazdušnih vodova'
            ],
            [
                'sektor_id' => '3',
                'naziv' => 'Služba za održavanje TS 35/XkV i kablova'
            ],
            [
                'sektor_id' => '3',
                'naziv' => 'Služba za podršku održavanja i mehanizacija'
            ],
            [
                'sektor_id' => '3',
                'naziv' => 'Služba za relejnu zaštitu i ispitivanje'
            ]
        ]);
    }
}
