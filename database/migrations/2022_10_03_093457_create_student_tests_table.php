<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('id_student')->unsigned();
            $table->foreign('id_student')->references('id')->on('students');
            $table->integer('id_test')->unsigned();
            $table->foreign('id_test')->references('id')->on('tests');
            $table->integer('id_axe')->unsigned();
            $table->foreign('id_axe')->references('id')->on('axes');
            $table->integer('score');
            $table->text('comment');
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
        Schema::dropIfExists('student_tests');
    }
}
