<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorHourAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_hour_appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_appointment_id')->unsigned();
            $table->bigInteger('hour_id')->unsigned();
            $table->foreign('doctor_appointment_id')->references('id')->on('doctor_appointments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hour_id')->references('id')->on('hours')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('doctor_hour_appointments');
    }
}
