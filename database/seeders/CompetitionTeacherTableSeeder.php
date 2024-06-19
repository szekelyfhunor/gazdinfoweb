<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitions_has_teachers')->insert([
            'competition_id'=> 1,
            'teacher_id'=> 1
        ]);

        DB::table('competitions_has_teachers')->insert([
            'competition_id'=> 1,
            'teacher_id'=> 2
        ]);

        DB::table('competitions_has_teachers')->insert([
            'competition_id'=> 2,
            'teacher_id'=> 2
        ]);
    }
}
