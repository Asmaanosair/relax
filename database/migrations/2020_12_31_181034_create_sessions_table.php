<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            
            $table->string('num');
            $table->longText('description');
            $table->enum('status',[0,1,2,3,4])->default(0);
            $table->enum('type',[0,1])->default(0);
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('treatment_id')->unsigned();
            $table->bigInteger('treatment_appointment_id')->unsigned();


            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('treatment_appointment_id')->references('id')->on('treatment_appointments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('treatment_id')->references('id')->on('treatments')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sessions');
    }
}
