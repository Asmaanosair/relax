<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditInsideDepartments4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inside_departments', function (Blueprint $table) {
            $table->dropForeign('inside_departments_admin_id_foreign');
            $table->dropForeign('inside_departments_psychologist_id_foreign');
            $table->dropColumn('admin_id');
            $table->dropColumn('psychologist_id');
      
         
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
