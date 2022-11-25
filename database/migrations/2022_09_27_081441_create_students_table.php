<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('record_number');
            $table->string('civility');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('birth_date');
            $table->string('nationality');
            $table->string('adress');
            $table->string('city');
            $table->string('postal_code');
            $table->string('phone');
            $table->string('parent_phone');
            $table->string('email');
            $table->string('school_level');
            $table->string('school');
            $table->string('opned_date');
            $table->string('photo');
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
        Schema::dropIfExists('students');
    }
}
