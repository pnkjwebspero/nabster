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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthdate');
            $table->string('location');
            $table->string('profile_image');
            $table->string('profile_image_thumbnail');
            $table->string('banner_image');
            $table->string('nationality')->nullable();
            $table->string('family_nationality')->nullable();
            $table->string('gender')->nullable();
            $table->string('orientation')->nullable();
            $table->string('relationship')->nullable();
            $table->string('religion')->nullable();
            $table->string('education_level')->nullable();
            $table->string('field_of_study')->nullable();
            $table->string('current_career_field')->nullable();
            $table->string('aspiring_career_field')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
