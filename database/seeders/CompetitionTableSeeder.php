<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitions')->insert([
            'id'=> 1,
            'title'=>'title1',
            'location'=>'location1',
            'type_of_participation_id'=>1,
            'result'=>1,
            'date'=> '2020-10-20'
        ]);

        DB::table('competitions')->insert([
            'id'=> 2,
            'title'=>'title2',
            'location'=>'location2',
            'type_of_participation_id'=>2,
            'result'=>4,
            'date'=> '2019-01-28'
        ]);
    }
}
