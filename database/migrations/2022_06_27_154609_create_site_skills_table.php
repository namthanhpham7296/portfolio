<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_skills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->double("rate");
            $table->integer("ordinal")->default(1)->index();
            $table->tinyInteger('is_public')->default(0)->comment("0:SHOW || 1: HIDE")->index();
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
        Schema::dropIfExists('site_skills');
    }
}
