<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            'id'=> 1,
            'user_id'=> 2,
            'title'=> 'New title1',
            'slug'=> 'slug1',
            'content'=> 'content1',
            'date' =>  Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('news')->insert([
            'id'=> 2,
            'user_id'=> 4,
            'title'=> 'New title2',
            'slug'=> 'slug2',
            'content'=> 'content2',
            'date' =>  Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
