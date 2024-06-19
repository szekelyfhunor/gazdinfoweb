<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(ItKlubTableSeeder::class);
        $this->call(ProgramTableSeeder::class);
        $this->call(ClasseTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(NewTableSeeder::class);
        $this->call(TeacherTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(TopicTableSeeder::class);
        $this->call(DiplomaTheseTableSeeder::class);
        $this->call(TypeOfParticipationTableSeeder::class);
        $this->call(CompetitionTableSeeder::class);
        $this->call(DiplomaTheseTeacherTableSeeder::class);
        $this->call(CompetitionTeacherTableSeeder::class);
        $this->call(CompetitionStudentTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(ModelRoleTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
        $this->call(PartnerTableSeeder::class);
    }
}
