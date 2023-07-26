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
        Schema::create('option_product_value', function (Blueprint $table) {
            $table->unsignedBigInteger('option_id');
            $table->foreign('option_id')->references('id')->on('options')->cascadeOnDelete();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->unsignedBigInteger('option_value_id');
            $table->foreign('option_value_id')->references('id')->on('option_values')->cascadeOnDelete();
            $table->unique(['option_id','product_id','option_value_id']);
            $table->float('price');
            $table->bigInteger('quantity');
            $table->bigInteger('point');
            $table->enum('price_prefix', ['+', '-'])->default('+');
            $table->enum('point_prefix', ['+', '-'])->default('+');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_product_value');
    }
};
