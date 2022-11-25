<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->integer('id_academy')->unsigned();
            $table->foreign('id_academy')->references('id')->on('academies');
            $table->integer('id_school_level')->unsigned();
            $table->foreign('id_school_level')->references('id')->on('school_levels');
            $table->integer('id_region');
            $table->string('type');
            $table->string('website');
            $table->string('name');
            $table->string('resume');
            $table->string('email');
            $table->string('phone');
            $table->string('mobile');
            $table->string('address');
            $table->string('city');
            $table->string('contact_name');
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
        Schema::dropIfExists('schools');
    }
}
