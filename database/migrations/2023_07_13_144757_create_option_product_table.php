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
        Schema::create('option_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('option_id');
            $table->foreign('option_id')->references('id')->on('options')->cascadeOnDelete();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->unique(['option_id','product_id']);
            $table->bigInteger('required')->default(0);
            $table->string('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_product');
    }
};
