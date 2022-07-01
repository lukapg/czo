<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'ime' => 'CZO',
                'prezime' => 'Administrator',
                'username' => 'czo.admin',
                'email' => '',
                'password' => bcrypt('cedis123'),
                'rola_id' => 1
            ],
            [
                'ime' => 'CZO',
                'prezime' => 'Pregled',
                'username' => 'czo.pregled',
                'email' => '',
                'password' => bcrypt('cedis123'),
                'rola_id' => 2
            ],
            [
                'ime' => 'Ljudski',
                'prezime' => 'resursi',
                'username' => 'ljudski.resursi',
                'email' => '',
                'password' => bcrypt('cedis123'),
                'rola_id' => 3
            ],
            [
                'ime' => 'Super',
                'prezime' => 'Administrator',
                'username' => 'admin',
                'email' => '',
                'password' => bcrypt('cedis123'),
                'rola_id' => 4
            ]
        ]);
    }
}
