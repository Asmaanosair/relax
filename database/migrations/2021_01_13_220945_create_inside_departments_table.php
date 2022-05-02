<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsideDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('inside_departments', function (Blueprint $table) {
            
            $table->id();

            $table->string('name');

            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null') ;
            
            $table->bigInteger('permanent_activity_id')->unsigned()->nullable();
            $table->foreign('permanent_activity_id')->references('id')->on('activities')->onDelete('set null');
            
            $table->bigInteger('variable_activity_id')->unsigned()->nullable();
            $table->foreign('variable_activity_id')->references('id')->on('activities')->onDelete('set null');
            
            $table->bigInteger('psychologist_id')->unsigned()->nullable();
            $table->foreign('psychologist_id')->references('id')->on('users')->onDelete('set null');
            
            $table->bigInteger('sociologist_id')->unsigned()->nullable();
            $table->foreign('sociologist_id')->references('id')->on('users')->onDelete('set null');
          
            $table->bigInteger('activity_executor_id')->unsigned()->nullable();
            $table->foreign('activity_executor_id')->references('id')->on('users')->onDelete('set null');

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
        Schema::dropIfExists('inside_departments');
    }
}
