<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsHasStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants_has_students', function (Blueprint $table) {
            $table->foreignId('applicants_for_theses_id')->constrained('applicants_for_theses', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('student_id')->constrained('students', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants_has_students');
    }
}
