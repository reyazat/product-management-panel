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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->nullable();
            $table->tinyText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->tinyText('tags')->nullable();
            $table->string('image')->nullable();
            $table->float('price');
            $table->float('supplier_price')->default(0.0);
            $table->float('weight')->default(0.0);
            $table->float('length')->default(0.0);
            $table->float('width')->default(0.0);
            $table->float('height')->default(0.0);
            $table->date('date_available')->nullable();
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('minimum')->default(0);
            $table->integer('tax_class_id')->default(0);
            $table->integer('manufacturer_id')->default(0);
            $table->string('meta_title')->nullable();
            $table->tinyText('meta_description')->nullable();
            $table->bigInteger('viewed')->default(0);
            $table->integer('sorted')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
