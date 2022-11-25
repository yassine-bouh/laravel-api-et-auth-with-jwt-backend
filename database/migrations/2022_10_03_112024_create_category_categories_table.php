<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('id_language')->unsigned();
            $table->foreign('id_language')->references('id')->on('languages');
            $table->integer('id_cat_one')->unsigned();
            $table->foreign('id_cat_one')->references('id')->on('categories');
            $table->integer('id_cat_two')->unsigned();
            $table->foreign('id_cat_two')->references('id')->on('categories');
            $table->string('resume');
            $table->text('detail');
            $table->string('principal');
            $table->string('activity');
            $table->string('actions');
            $table->string('quality');
            $table->string('image');
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
        Schema::dropIfExists('category_categories');
    }
}
