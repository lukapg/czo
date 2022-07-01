<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rola')->insert([
            [
                'naziv' => 'CZO - administrator',
            ],
            [
                'naziv' => 'CZO - pregled',
            ],
            [
                'naziv' => 'Ljudski resursi',
            ],
            [
                'naziv' => 'Administrator',
            ],
        ]);
    }
}
