<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsForSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
           $table->string("driver_mail")->nullable()->after("transport_mail");
           $table->string("from_address_email")->nullable()->after("driver_mail");
           $table->string("from_name_mail")->nullable()->after("from_address_email");
           $table->string("encryption_mail")->nullable()->after("from_name_mail");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
