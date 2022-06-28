<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("company_id")->nullable()->comment("Mã công ty")->index();
            $table->string("code", 20)->nullable()->comment("Mã")->index();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();

            $table->string("avatar")->nullable()->comment("Ảnh đại diện");
            $table->string("phone", 20)->nullable()->comment("Ảnh đại diện");
            $table->date("birthday")->nullable()->comment("Ngày sinh");
            $table->string("address")->nullable()->comment("Ảnh đại diện");
            $table->string("contact_email", 100)->nullable()->comment("Ảnh đại diện");
            $table->text("self_introduction")->nullable()->comment("Giới thiệu");

            $table->string("functions_access")->nullable()->comment("Quyền truy cập chức năng");
            $table->string("modules_access")->nullable()->comment("Quyền truy cập module");
            $table->integer("is_admin")->nullable()->comment("Mã phân quyền")->index();
            $table->integer("status")->default(1)->comment("1: Hoạt động | 0: Đã khóa");
            $table->integer("register_by")->default(1)->comment("1: Email | 2: Google | 3: Facebook | 4: Phone");

            $table->string("lang_key", 10)->nullable()->default('en')->comment("Ngôn ngữ")->index();
            $table->dateTime("lasted_login")->nullable()->comment("Đăng nhập lần cuối")->index();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
