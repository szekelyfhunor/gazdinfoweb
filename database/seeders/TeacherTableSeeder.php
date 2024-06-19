<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'user_id'=> 4,
            'degree'=>'degree1' ,
            'post'=>'post1'
        ]);

        DB::table('teachers')->insert([
            'user_id'=> 5,
            'degree'=>'degree2' ,
            'post'=>'post2'
        ]);
    }
}
