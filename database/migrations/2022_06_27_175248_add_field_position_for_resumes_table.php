<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldPositionForResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_resumes', function (Blueprint $table) {
            $table->tinyInteger('position')->default(1)->comment("1: LEFT || 2: RIGHT")->after('links');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_resumes', function (Blueprint $table) {
            //
        });
    }
}
