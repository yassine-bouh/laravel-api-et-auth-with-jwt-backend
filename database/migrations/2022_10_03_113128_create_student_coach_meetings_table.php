<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCoachMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_coach_meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('resume');
            $table->string('type');
            $table->text('detail');
            $table->datetime('meeting_date');
            $table->integer('id_student_coach')->unsigned();
            $table->foreign('id_student_coach')->references('id')->on('student_coaches');
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
        Schema::dropIfExists('student_coach_meetings');
    }
}
