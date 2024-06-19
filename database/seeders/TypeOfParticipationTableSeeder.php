<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfParticipationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_of_participations')->insert([
            'id'=> 1,
            'name'=>'TDK',
        ]);
        DB::table('type_of_participations')->insert([
            'id'=> 2,
            'name'=>'ETDK',
        ]);
        DB::table('type_of_participations')->insert([
            'id'=> 3,
            'name'=>'OTDK',
        ]);
        DB::table('type_of_participations')->insert([
            'id'=> 4,
            'name'=>'Hechatlon',
        ]);
    }
}
