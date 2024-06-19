<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Szuper Admin',
            'password' => '$2y$10$nbkrQ/5D2IvmOxa2YQWyIuIOG3X72fQ3HZg36AyeJB9kruHG/lhBa',
            'email' => 'admin@admin.com',
            'phone' => '0744556611',
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Ádám',
            'password' => 'password1',
            'email' => 'email1@gmail.com',
            'phone' => '0722334455',
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Éva',
            'password' => 'password2',
            'email' => 'email2@gmail.com',
            'phone' => '0711223344',
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Romeo',
            'password' => 'password3',
            'email' => 'email3@gmail.com',
            'phone' => '0733445566',
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Julia',
            'password' => 'password4',
            'email' => 'email4@gmail.com',
            'phone' => '0744556677',
        ]);


    }
}
