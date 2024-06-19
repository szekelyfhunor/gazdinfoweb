<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            'id' =>1,
            'current_grade' =>2,
            'enrolled' =>30,
            'graduated_number' =>0,
            'is_finished' =>0,
            'year' => 2021
        ]);

        DB::table('classes')->insert([
            'id' =>2,
            'current_grade' =>3,
            'enrolled' =>25,
            'graduated_number' =>20,
            'is_finished' =>1,
            'year' => 2020
        ]);
    }
}
