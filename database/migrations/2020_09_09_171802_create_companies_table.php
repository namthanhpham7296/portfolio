<?php

use App\Helpers\BaseService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->double('address_lat')->nullable();
            $table->double('address_lng')->nullable();
            $table->string('province')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('website')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_alt')->nullable();
            $table->string('logo_title')->nullable();
            $table->string('copyright')->nullable();
            $table->string('description')->nullable();
            $table->string('title')->nullable();
            $table->text('keywords')->nullable();
            $table->string('slogan')->nullable();
            $table->string('hotline')->nullable();
            $table->string('banner')->nullable();
            $table->string('pinterest_url')->nullable();
            $table->string('zalo_phone_number')->nullable();
            $table->string('whatsapp_phone_number')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('working_hour')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('terms_of_services')->nullable();

            $table->string("facebook_url")->nullable()->comment("Fanpage facebook")->index();
            $table->string("youtube_url")->nullable()->comment("Youtube chanel")->index();
            $table->string("twitter_url")->nullable()->comment("Twitter chanel")->index();
            $table->string("instagram_url")->nullable()->comment("Instagram")->index();

            $table->integer("status")->nullable()->comment("0: Inactive | 1: Active")->index();
            $table->integer("type")->nullable()->comment("1: Master Company | 1: Travel Agent")->index();
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
        Schema::dropIfExists('companies');
    }
}
