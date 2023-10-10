<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('country_code')->nullable();
            $table->string('mobile_number')->nullable();
            $table->tinyInteger('is_accepted_policy')->default(0)->comment('0 => NO, 1 => YES');
            $table->tinyInteger('login_type')->default(0)->comment('0 => Web, 1 => Google, 2 => Facebook');
            $table->tinyInteger('user_type')->default(3)->comment('0 => Super Admin, 1 => Moderate, 2 => Advertizer, 3 => User');
            $table->timestamp('last_login')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 => Deactive, 1 => Active, 2 => Suspended, 3 => Deleted/Ban');
            $table->tinyInteger('email_verified')->default(0)->comment('0 => NO, 1 => YES')->nullable();
            $table->tinyInteger('number_verified')->default(0)->comment('0 => NO, 1 => YES')->nullable();
            $table->tinyInteger('is_user_verified')->default(0)->comment('0 => NO, 1 => YES')->nullable();
            $table->string('number_otp')->nullable();
            $table->string('email_otp')->nullable();
            $table->timestamp('number_otp_validity')->nullable();
            $table->timestamp('email_otp_validity')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
