<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFields20220627ForResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_resumes', function (Blueprint $table) {
            $table->string("links")->nullable()->after("subtitle");
            $table->string("photo")->nullable()->after("links");
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
