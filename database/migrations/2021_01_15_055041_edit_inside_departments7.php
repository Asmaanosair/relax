<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditInsideDepartments7 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inside_departments', function (Blueprint $table) {
            $table->integer('admin_id')->nullable();
            $table->integer('psychologist_id')->nullable();
            $table->integer('activity_executor_id')->nullable();
            $table->integer('sociologist_id')->nullable();
      
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
