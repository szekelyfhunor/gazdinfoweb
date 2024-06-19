<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'name' => 'Programozás alapjai (Python)',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Java programozás',
        ]);

        DB::table('subjects')->insert([
            'name' => 'HTML',
        ]);

        DB::table('subjects')->insert([
            'name' => 'CSS',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Javascript',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Laravel',
        ]);

        DB::table('subjects')->insert([
            'name' => 'VueJs',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Reszponzív web alkalmazások',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Mobileszközök programozása (Android)',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Operációkutatás',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Adatbázisok tervezése',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Számítógépes hálózatok',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Operációs rendszerek',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Mikroökonómia',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Makroökonómia',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Integrált vállalatirányítási rendszerek (SAP)',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Pénzügyi folyamatok modellezése',
        ]);

        DB::table('subjects')->insert([
            'name' => 'Szakértői rendszerek tervezése',
        ]);

    }
}
