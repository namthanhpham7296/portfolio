<?php

use App\Helpers\BaseService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("company_id")->nullable()->comment("Mã công ty");
            $table->string("code", 50)->nullable()->comment("Mã ngôn ngữ");
            $table->string("name", 100)->nullable()->comment("Tên ngôn ngữ");

            $table->string("flag")->nullable()->comment("Cờ");
            $table->tinyInteger("is_default")->default(0)->comment("0: No | 1: Yes");
            $table->tinyInteger("status")->default(1)->comment("Trạng thái");
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
        Schema::dropIfExists('languages');
    }
}
