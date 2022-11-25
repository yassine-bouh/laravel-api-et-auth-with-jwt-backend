<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_coaches', function (Blueprint $table) {
            $table->id();
            $table->integer('id_student')->unsigned();
            $table->foreign('id_student')->references('id')->on('students');
            $table->integer('id_coach')->unsigned();
            $table->foreign('id_coach')->references('id')->on('coaches');
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
        Schema::dropIfExists('student_coaches');
    }
}

