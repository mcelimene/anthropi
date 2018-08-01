<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('phone_number')->default('Non renseigné');
            $table->string('social_security')->default('Non renseigné');
            $table->date('birthdate');
            $table->date('senority')->default('Non renseigné');
            $table->string('job');
            $table->string('speciality');
            $table->string('cv')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table){
            $table->integer('trainer_id')->unsigned()->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainers');
    }
}
