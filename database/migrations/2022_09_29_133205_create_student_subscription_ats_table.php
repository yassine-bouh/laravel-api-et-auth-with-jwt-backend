<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubscriptionAtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subscription_ats', function (Blueprint $table) {
            $table->id();
            $table->integer('id_student')->unsigned();
            $table->foreign('id_student')->references('id')->on('students');
            $table->integer('id_subscription')->unsigned();
            $table->foreign('id_subscription')->references('id')->on('subscriptions');
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
        Schema::dropIfExists('student_subscription_ats');
    }
}
