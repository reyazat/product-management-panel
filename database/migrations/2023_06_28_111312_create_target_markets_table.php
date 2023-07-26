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
        Schema::create('target_markets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->tinyText('description')->nullable();
            $table->tinyInteger('approve_customer')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_markets');
    }
};
