<?php

use App\Helpers\BaseService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("company_id")->nullable()->comment("Mã công ty")->index();
            $table->string("keyword")->nullable()->comment("")->index();
            $table->text("content")->nullable()->comment("");
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
        Schema::dropIfExists('localizes');
    }
}
