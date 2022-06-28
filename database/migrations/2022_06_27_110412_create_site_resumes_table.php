<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_resumes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable()->index();
            $table->string('subtitle')->nullable()->index();
            $table->text('content')->nullable()->index();
            $table->date('from')->nullable()->index();
            $table->date('to')->nullable()->index();
            $table->integer("ordinal")->default(1)->index();
            $table->tinyInteger('show_homepage')->default(0)->comment("0:SHOW || 1: HIDE")->index();
            $table->tinyInteger('status')->default(1)->comment("1: ACTIVE || 2: INACTIVE")->index();
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
        Schema::dropIfExists('site_resumes');
    }
}
