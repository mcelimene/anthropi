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
            $table->smallInteger('number_of_trainers')->default(0);
            $table->smallInteger('number_of_assistant_trainers')->default(0);
            $table->smallInteger('number_of_instructors')->default(0);
            $table->smallInteger('number_of_course_directors')->default(0);
            $table->text('date_start');
            $table->text('date_end');
            $table->boolean('send_email')->default(false);
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
        Schema::dropIfExists('formations');
    }
}
