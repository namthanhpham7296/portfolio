<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_menus', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->string('name')->nullable()->index();
            $table->string('url')->nullable()->index();
            $table->uuid('parent_id')->nullable();
            $table->integer("ordinal")->default(1)->index();
            $table->tinyInteger('is_redirect')->default(0)->index();
            $table->tinyInteger('is_public')->default(0)->index();
            $table->tinyInteger('status')->default(1)->comment("1: ACTIVE || 2: INACTIVE")->index();
            $table->primary('id');
            $table->foreign('parent_id')->references('id')->on('site_menus')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('site_menus');
    }
}
