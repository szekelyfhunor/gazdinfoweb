<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([

            'user_id'=> 2,
            'classes_id'=>1,
            'workplace'=> "workplace1",
            'year_of_finish' => 2022

        ]);

        DB::table('students')->insert([

            'user_id'=> 3,
            'classes_id'=>2,
            'workplace'=> "workplace2",
            'year_of_finish' => 2021
        ]);


    }
}
