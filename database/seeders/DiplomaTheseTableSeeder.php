<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiplomaTheseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    DB::table('diploma_theses')->insert([
        'id' => 1,
        'student_id' => 2,
        'title' => 'title1',
        'abstract' => 'abstract_value1', 
        'status' => 'status_value1', 
    ]);

    DB::table('diploma_theses')->insert([
        'id' => 2,
        'student_id' => 1,
        'title' => 'title2',
        'abstract' => 'abstract_value2', 
        'status' => 'status_value2', 
    ]);
}
}
