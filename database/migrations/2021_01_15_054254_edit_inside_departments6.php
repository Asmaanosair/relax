<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditInsideDepartments6 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inside_departments', function (Blueprint $table) {
            $table->dropForeign('inside_departments_sociologist_id_foreign');
            $table->dropForeign('inside_departments_activity_executor_id_foreign');
            $table->dropColumn('sociologist_id');
            $table->dropColumn('activity_executor_id');
          
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
