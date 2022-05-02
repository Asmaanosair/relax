<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('doctor_appointment_id')->unsigned();
            $table->bigInteger('hour_id')->unsigned();
            $table->bigInteger('payment_method_id')->unsigned();
            $table->enum('status',[0,1,2,3,4])->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hour_id')->references('id')->on('hours')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('doctor_appointment_id')->references('id')->on('doctor_appointments')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('appointments');
    }
}
