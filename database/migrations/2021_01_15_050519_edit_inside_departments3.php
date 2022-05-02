<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditInsideDepartments3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inside_departments', function (Blueprint $table) {
            $table->string('permanent_activity_id')->nullable();
            $table->string('variable_activity_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inside_departments', function (Blueprint $table) {
            //
        });
    }
}
