<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'id' => 1,
            'reviewer' => 'Kiss Bernadett',
            'opinion' => 'Donec vulputate convallis dui ac imperdiet. Etiam pharetra tellus ut bibendum aliquam. Nullam feugiat a enim at sollicitudin. Fusce quis enim sit amet enim mollis posuere.',
            'date' => '2018-07-04',
        ]);

        DB::table('reviews')->insert([
            'id' => 2,
            'reviewer' => 'Tóth Nóra',
            'opinion' => 'Donec vulputate convallis dui ac imperdiet. Etiam pharetra tellus ut bibendum aliquam. Nullam feugiat a enim at sollicitudin. Fusce quis enim sit amet enim mollis posuere.',
            'date' => '2020-03-21',
        ]);

        DB::table('reviews')->insert([
            'id' => 3,
            'reviewer' => 'Nagy Béla',
            'opinion' => 'Donec vulputate convallis dui ac imperdiet. Etiam pharetra tellus ut bibendum aliquam. Nullam feugiat a enim at sollicitudin. Fusce quis enim sit amet enim mollis posuere.',
            'date' => '2021-07-14',
        ]);

    }
}
