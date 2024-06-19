<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert([
            'id' => 1,
            'institution' => 'Sapientia-EMTE',
            'faculty' => 'Csíkszereda',
            'name_hu' => 'Gazdasági informatika',
            'name_ro' => 'Informatică economică',
            'study_level' => 'Alapképzés',
            'field_of_study' => 'Gazdaság',
            'description' => 'A képzés célja olyan szakemberek képzése, akik képesek az információtechnológia korszerű lehetőségeit kihasználva, a valós gazdasági-, üzleti folyamatok megértésére, modellezésére, a problémák megfogalmazására és megoldásukra vagy megoldási javaslattételre.

                              A gazdasági informatikus megfelelő ismeretekkel és jártassággal rendelkezik a gazdasági tevékenységgel összefüggő informatikai problémák feltárására és megoldására, a vállalatok számára szükséges informatikai alkalmazások fejlesztésére, működtetésére és a működés elvárt minőségnek megfelelő felügyeletére.',
            'accreditation' => '2018-06-29'
        ]);

    }
}










