<?php

use App\Helpers\BaseService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLogonLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logon_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->index();
            $table->date('ondate')->index();
            $table->time('ontime')->index();
            $table->integer('user_id')->index();
            $table->string('source_ip', 50)->nullable()->index();
            $table->string('source_area')->nullable()->index();
            $table->text('browser')->nullable();
            $table->string("user_agent")->nullable()->index();
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
        Schema::dropIfExists('user_logon_logs');
    }
}
