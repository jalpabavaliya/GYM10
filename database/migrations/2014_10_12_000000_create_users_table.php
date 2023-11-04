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
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            // $table->string('heart_rate')->nullable();
            $table->string('provider')->nullable();
            $table->string('social_id')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->integer('otp')->nullable();
            $table->string('goal')->nullable();
            $table->string('medical_condition')->nullable();
            $table->string('activity')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('verification_code')->nullable();
            $table->boolean('active_status')->default(0);
            $table->string('google_id')->nullable();
            $table->rememberToken();
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
