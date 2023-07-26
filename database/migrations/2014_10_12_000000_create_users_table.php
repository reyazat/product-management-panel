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
            $table->string('fullname')->nullable();
            $table->string('company')->nullable();
            $table->string('company_signatory')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->bigInteger('code')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('Identity')->nullable();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('terms')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->tinyText('address')->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->json('user_settings')->nullable();
            $table->string('taxcode')->nullable();
            $table->string('file')->nullable();
            $table->enum('role', ['Admin', 'Dev', 'User'])->default('User');
            $table->enum('type', ['real', 'legal'])->default('real');
            $table->tinyInteger('status')->default(1);
            $table->tinyText('accesstoken')->nullable();
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
