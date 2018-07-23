<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::table('trainers', function (Blueprint $table){
            $table->integer('level_id')->unsigned()->index();
        });

        Schema::create('formation_level', function(Blueprint $table){
          $table->increments('id');
          $table->integer('formation_id')->unsigned()->index();
          $table->integer('level_id')->unsigned()->index();
          $table->smallInteger('number_of_vacancies');
          $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
}
