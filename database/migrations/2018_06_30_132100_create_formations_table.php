<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('place');
            $table->text('educational_objective');
            $table->date('date_start');
            $table->time('time_start');
            $table->date('date_end');
            $table->time('time_end');
            $table->boolean('send_email')->default(false);
            $table->boolean('validation_registrations')->default(false);
            $table->timestamps();
        });

        Schema::create('formation_trainer', function(Blueprint $table){
          $table->increments('id');
          $table->integer('formation_id')->unsigned()->index();
          $table->integer('trainer_id')->unsigned()->index();
          $table->string('answer_trainer')->default('en attente');
          $table->boolean('answer_admin')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formations');
    }
}
