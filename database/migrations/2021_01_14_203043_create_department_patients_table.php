<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_patients', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('inside_department_id')->unsigned()->nullable();
            $table->foreign('inside_department_id')->references('id')->on('inside_departments')->onDelete('cascade');

            $table->bigInteger('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('set null');

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
        Schema::dropIfExists('department_patients');
    }
}
