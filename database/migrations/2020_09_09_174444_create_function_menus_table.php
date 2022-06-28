<?php

use App\Helpers\BaseService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('function_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('module_id')->nullable();
            $table->integer('parent_id')->default(0)->nullable();
            $table->integer('semi_parent_id')->default(0)->nullable();
            $table->string('name', 150)->nullable()->index();
            $table->string('plugin', 50)->nullable()->index();
            $table->string('controller', 50)->nullable()->index();
            $table->string('action', 50)->nullable()->index();
            $table->string('params', 100)->nullable()->index();
            $table->string('cls_icon', 50)->nullable()->index();
            $table->string('link', 300)->nullable();
            $table->tinyInteger('is_link')->default(0)->nullable()->comment('0: not link | 1: link');
            $table->tinyInteger('is_fullscreen')->default(0)->nullable()->comment('0: default screen | 1: fullscreen');
            $table->tinyInteger('is_ajax')->default(0)->nullable()->comment('0: default function | 1: ajax function');
            $table->tinyInteger('open_new_tab')->default(0)->nullable()->comment('0: current screen | 1: open in new tab');
            $table->tinyInteger('display')->default(0)->nullable()->comment('0: hide | 1: display in left menu');
            $table->tinyInteger('ordinal')->default(1)->nullable()->comment('Ordinal to show in left menu');
            $table->tinyInteger('status')->default(1)->nullable()->comment('0: Inactive | 1: Active');
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
        Schema::dropIfExists('function_menus');
    }
}
