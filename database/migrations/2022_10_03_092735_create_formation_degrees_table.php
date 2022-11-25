<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormationDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('formation_degrees', function (Blueprint $table) {
            $table->id();
            $table->integer('id_formation')->unsigned();
            $table->foreign('id_formation')->references('id')->on('formations');
            $table->integer('id_degree')->unsigned();
            $table->foreign('id_degree')->references('id')->on('degrees');
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
        Schema::dropIfExists('formation_degrees');
    }
}
