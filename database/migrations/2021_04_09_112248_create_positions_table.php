<?php

use App\Helpers\BaseService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.`
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("company_id")->nullable();
            $table->integer("parent_id")->nullable();
            $table->string("function_access")->nullable();
            $table->string("code")->nullable()->comment("Mã chức vụ");
            $table->string("name")->nullable()->comment("Tên chức vụ");
            $table->string("description")->nullable()->comment("Mô tả");
            $table->tinyInteger("status")->default(1)->comment("0: Đang chờ || 1: Hoạt động");
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
        Schema::dropIfExists('positions');
    }
}
