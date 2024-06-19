<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('institution')->nullable();
            $table->string('faculty')->nullable();
            $table->string('name_hu')->nullable();
            $table->string('name_ro')->nullable();
            $table->string('study_level')->nullable();
            $table->string('field_of_study')->nullable();
            $table->longText('description')->nullable();
            $table->date('accreditation');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
