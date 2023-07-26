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
        Schema::create('product_target_market', function (Blueprint $table) {
            $table->unsignedBigInteger('target_market_id');
            $table->foreign('target_market_id')->references('id')->on('target_markets')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unique(['target_market_id','product_id']);
            $table->float('price');
            $table->bigInteger('quantity')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_target_market');
    }
};
