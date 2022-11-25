<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->integer('id_institution_type')->unsigned();
            $table->foreign('id_institution_type')->references('id')->on('institution_types');
            $table->string('name');
            $table->string('resume');
            $table->string('website');
            $table->string('email');
            $table->string('phone');
            $table->string('mobile');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('contact_name');
            $table->string('logo');
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
        Schema::dropIfExists('institutions');
    }
}
