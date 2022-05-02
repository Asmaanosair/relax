<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_appointments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('day');
            $table->time('from');
            $table->time('to');
            $table->bigInteger('treatment_id')->unsigned();
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
        Schema::dropIfExists('treatment_appointments');
    }
}
