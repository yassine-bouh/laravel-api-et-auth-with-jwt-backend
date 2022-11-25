<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('id_invoice')->unsigned();
            $table->foreign('id_invoice')->references('id')->on('invoices');
            $table->integer('id_student_coach')->unsigned();
            $table->foreign('id_student_coach')->references('id')->on('student_coaches');
            $table->integer('id_program')->unsigned();
            $table->foreign('id_program')->references('id')->on('programs');
            $table->string('last_status');
            $table->datetime('last_status_date');
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
        Schema::dropIfExists('inscriptions');
    }
}
