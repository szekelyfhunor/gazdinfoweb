<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitions_has_students')->insert([
            'competition_id'=> 1,
            'student_id'=> 1

        ]);

        DB::table('competitions_has_students')->insert([
            'competition_id'=> 1,
            'student_id'=> 2
        ]);
        DB::table('competitions_has_students')->insert([
            'competition_id'=> 2,
            'student_id'=> 1
        ]);

    }
}
