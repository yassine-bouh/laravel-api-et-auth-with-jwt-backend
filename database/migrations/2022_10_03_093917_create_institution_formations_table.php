<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('institution_formations', function (Blueprint $table) {
            $table->id();
            $table->integer('id_formation')->unsigned();
            $table->foreign('id_formation')->references('id')->on('formations');
            $table->integer('id_institution')->unsigned();
            $table->foreign('id_institution')->references('id')->on('institutions');
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
        Schema::dropIfExists('institution_formations');
    }
}
