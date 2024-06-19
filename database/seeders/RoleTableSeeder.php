<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'SzuperAdminisztrátor',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'Adminisztrátor',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'Tanár',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'Hallgató',
            'guard_name' => 'web',
        ]);
    }
}
