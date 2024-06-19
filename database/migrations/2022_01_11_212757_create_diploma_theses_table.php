<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomaThesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diploma_theses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students','id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->text('abstract');
            $table->string('status');
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
        Schema::dropIfExists('diploma_theses');
    }
}
