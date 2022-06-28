<?php

use App\Helpers\BaseService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("company_id")->nullable()->comment("Mã công ty");
            $table->string("host_mail")->nullable()->comment("Host mail");
            $table->integer("port_mail")->nullable()->comment("Port mail");
            $table->string("username_mail")->nullable()->comment("Username mail");
            $table->string("password_mail")->nullable()->comment("Password mail");
            $table->string("transport_mail")->nullable()->comment("Transport mail");

            $table->mediumText("facebook_pixel_code")->nullable()->comment("");
            $table->mediumText("facebook_body_code")->nullable()->comment("");
            $table->mediumText("facebook_title")->nullable()->comment("");
            $table->mediumText("facebook_description")->nullable()->comment("");
            $table->mediumText("facebook_thumbnail")->nullable()->comment("");

            $table->mediumText("seo_page_title")->nullable()->comment("");
            $table->mediumText("seo_page_description")->nullable()->comment("");
            $table->mediumText("seo_page_keywords")->nullable()->comment("");
            $table->mediumText("google_analytics_key")->nullable()->comment("");

            $table->string("api_jwt_secret")->nullable()->comment("");
            $table->string("google_map_api_key")->nullable()->comment("");
            $table->string("google_recaptcha_api_key")->nullable()->comment("");
            $table->string("google_recaptcha_api_secret_key")->nullable()->comment("");
            $table->string("google_api_url")->nullable()->comment("");

            $table->string("firebase_api_key")->nullable()->comment("");
            $table->string("firebase_auth_domain")->nullable()->comment("");
            $table->string("firebase_db_url")->nullable()->comment("");
            $table->string("firebase_project_id")->nullable()->comment("");
            $table->string("firebase_store_bucket")->nullable()->comment("");
            $table->string("firebase_sender_id")->nullable()->comment("");
            $table->string("firebase_app_id")->nullable()->comment("");
            $table->string("firebase_measurement_id")->nullable()->comment("");

            $table->string("mobile_sdk_app_id")->nullable()->comment("");
            $table->tinyInteger("turn_off_recaptcha")->nullable()->comment("0: no | 1: yes");
            $table->string("server_key")->nullable()->comment("");

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
        Schema::dropIfExists('settings');
    }
}
