<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partners')->insert([
            'id' => 1,
            'name' => 'IT Plusz Klaszter',
        ]);

        DB::table('partners')->insert([
            'id' => 2,
            'name' => 'Csíki Vállalkozók Egyesülete',
        ]);

        DB::table('partners')->insert([
            'id' => 3,
            'name' => 'Enetix Software',
        ]);

        DB::table('partners')->insert([
            'id' => 4,
            'name' => 'Magic Solutions',
        ]);

        DB::table('partners')->insert([
            'id' => 5,
            'name' => 'Camel Coding',
        ]);

        DB::table('partners')->insert([
            'id' => 6,
            'name' => 'Nextra Software',
        ]);
    }
}
