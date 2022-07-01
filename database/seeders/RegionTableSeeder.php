<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('region')->insert([
            [
                'naziv' => 'Region 1',
            ],
            [
                'naziv' => 'Region 2',
            ],
            [
                'naziv' => 'Region 3',
            ],
            [
                'naziv' => 'Region 4',
            ],
            [
                'naziv' => 'Region 5',
            ],
            [
                'naziv' => 'Region 6',
            ],
            [
                'naziv' => 'Region 7',
            ]
        ]);
    }
}
