<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiplomaTheseTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diploma_t_has_teachers')->insert([
            'diploma_thesis_id' => 1,
            'teacher_id' => 1
        ]);

        DB::table('diploma_t_has_teachers')->insert([
            'diploma_thesis_id' => 2,
            'teacher_id' => 1
        ]);
        DB::table('diploma_t_has_teachers')->insert([
            'diploma_thesis_id' => 2,
            'teacher_id' => 2
        ]);


    }
}
