<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            'id'=> 1,
            'name'=>'Laravel',
        ]);
        DB::table('topics')->insert([
            'id'=> 2,
            'name'=>'PHP',
        ]);
        DB::table('topics')->insert([
            'id'=> 3,
            'name'=>'Javascript',
        ]);
        DB::table('topics')->insert([
            'id'=> 4,
            'name'=>'MySql',
        ]);
        DB::table('topics')->insert([
            'id'=> 5,
            'name'=>'Python',
        ]);
        DB::table('topics')->insert([
            'id'=> 6,
            'name'=>'Java',
        ]);
        DB::table('topics')->insert([
            'id'=> 7,
            'name'=>'VBA',
        ]);
        DB::table('topics')->insert([
            'id'=> 8,
            'name'=>'Excel',
        ]);
        DB::table('topics')->insert([
            'id'=> 9,
            'name'=>'CLIPS',
        ]);
    }
}
